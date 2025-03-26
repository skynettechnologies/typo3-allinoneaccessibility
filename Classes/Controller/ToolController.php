<?php
namespace Skynettechnologies\Allinoneaccessibility\Controller;

use Skynettechnologies\Allinoneaccessibility\AdaConstantModule\TypoScriptTemplateConstantEditorModuleFunctionController;
use Skynettechnologies\Allinoneaccessibility\Property\TypeConverter\UploadedFileReferenceConverter;
use TYPO3\CMS\Core\TypoScript\ExtendedTemplateService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Annotation\Inject as inject;
use TYPO3\CMS\Extbase\Property\PropertyMappingConfiguration;
use TYPO3\CMS\Tstemplate\Controller\TypoScriptTemplateModuleController;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Database\ConnectionPool;
/***
 *
 * This file is part of the "All in one Accessibility" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020
 *
 ***/

/**
 * ToolController
 */
class ToolController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * ToolRepository
     *
     * @var \Skynettechnologies\Allinoneaccessibility\Domain\Repository\ToolRepository
     * @inject
     */
    protected $ToolRepository = null;

    /**
     * @param \Skynettechnologies\Allinoneaccessibility\Domain\Repository\ToolstyleRepository $ToolstyleRepository
     */
    public function injectToolstyleRepository(\Skynettechnologies\Allinoneaccessibility\Domain\Repository\ToolstyleRepository $toolstyleRepository)
    {
        $this->toolstyleRepository = $toolstyleRepository;
    }

    protected $templateService;

    protected $constantObj;

    protected $constants;

    /**
     * @var TypoScriptTemplateModuleController
     */
    protected $pObj;

    protected $contentObject = null;

    protected $pid = null;

    /**
     * Initializes this object
     *
     * @return void
     */
    public function initializeObject()
    {
        $this->contentObject = GeneralUtility::makeInstance('TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer');
        $this->templateService = GeneralUtility::makeInstance(ExtendedTemplateService::class);
        $this->constantObj = GeneralUtility::makeInstance(TypoScriptTemplateConstantEditorModuleFunctionController::class);
    }

    /**
     * Initialize Action
     *
     * @return void
     */
    public function initializeAction()
    {

        //GET CONSTANTs
        $this->constantObj->init($this->pObj);
        $this->constants = $this->constantObj->main();
    }

    /**
     * action list
     *
     * @return ResponseInterface
     */
    public function mainAction(): ResponseInterface
    {
        return $this->htmlResponse();
    }
    
    /**
     * action widgetSettingsAction
     *
     * @return void
     */
    public function widgetSettingsAction()
    {

         $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('be_users');

        $query = $queryBuilder
            ->select('*')
            ->from('be_users');

        $result = $query->execute()->fetchAll();
        foreach($result as $row){
       
        }
        $user_name = $row['username'];
        $user_email = $row['email'];
     
      
        $this->view->assign('username', $user_name);
        $this->view->assign('useremail', $user_email);
        

        return $this->htmlResponse();
    }

}
