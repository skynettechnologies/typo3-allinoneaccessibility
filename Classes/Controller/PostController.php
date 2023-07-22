<?php
declare(strict_types = 1);

namespace Allinone\Allinoneaccessibility\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Backend\Template\ModuleTemplate;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3\CMS\Core\Core\Environment;

class PostController extends ActionController
{

    public function initializePostsAction(): void
    {
    }

    public function initializeAction(): void
    {
        $this->moduleTemplate = GeneralUtility::makeInstance(ModuleTemplate::class);
        $this->iconFactory = $this->moduleTemplate->getIconFactory();
        $this->buttonBar = $this->moduleTemplate->getDocHeaderComponent()->getButtonBar();

        /* $pageRenderer = $this->moduleTemplate->getPageRenderer(); */
        $pageRenderer = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Page\PageRenderer::class);
    }


    public function mainAction(): string
    {
        $domain = $_SERVER['HTTP_HOST'];
        $projectName = end(explode("/",(Environment::getProjectPath())));
        $hash = sha1($projectName."typo3_accessibility_" . preg_replace("/www\.|https?:\/\/|\/$|\/?\?.+|\/.+|^\./", '', $domain));
        return $this->render('Backend/Front.html', [
            'hash' => $hash,
            'domain' => $domain
        ]);
    }



    protected function getFluidTemplateObject(string $templateNameAndPath): StandaloneView
    {
        $view = GeneralUtility::makeInstance(StandaloneView::class);
        $view->setLayoutRootPaths([GeneralUtility::getFileAbsFileName('EXT:allinoneaccessibility/Resources/Private/Layouts')]);
        $view->setPartialRootPaths([GeneralUtility::getFileAbsFileName('EXT:allinoneaccessibility/Resources/Private/Partials')]);
        $view->setTemplateRootPaths([GeneralUtility::getFileAbsFileName('EXT:allinoneaccessibility/Resources/Private/Templates')]);
        $view->setTemplatePathAndFilename(GeneralUtility::getFileAbsFileName('EXT:allinoneaccessibility/Resources/Private/Templates/' . $templateNameAndPath));
        $view->setControllerContext($this->getControllerContext());
        $view->getRequest()->setControllerExtensionName('Blog');

        return $view;
    }

    protected function render(string $templateNameAndPath, array $values): string
    {
        $view = $this->getFluidTemplateObject($templateNameAndPath);
        $view->assign('_template', $templateNameAndPath);
        $view->assign('action', $this->actionMethodName);
        $view->assignMultiple($values);
        $this->moduleTemplate->setContent($view->render());

        return $this->moduleTemplate->renderContent();
    }

}
