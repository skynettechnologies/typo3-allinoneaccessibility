<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function () {
        if (version_compare(TYPO3_branch, '10.0', '>=')) {
            $moduleClass = \Skynettechnologies\Allinoneaccessibility\Controller\ToolController::class;
        } else {
            $moduleClass = 'Tool';
        }
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Skynettechnologies.Allinoneaccessibility',
            'Tool',
            [
                $moduleClass => 'list, update, create',
            ],
            // non-cacheable actions
            [
                $moduleClass => 'update, create',
            ]
        );

        $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);

        $iconRegistry->registerIcon(
            'allinoneaccessibility-plugin-tool',
            \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            ['source' => 'EXT:allinoneaccessibility/Resources/Public/Icons/user_plugin_whatsapp.svg']
        );

        $iconRegistry->registerIcon(
            'module-allinoneaccessibility',
            \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            ['source' => 'EXT:allinoneaccessibility/Resources/Public/Icons/module-sntg.svg']
        );
    }
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerTypeConverter('Skynettechnologies\\Allinoneaccessibility\\Property\\TypeConverter\\UploadedFileReferenceConverter');
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerTypeConverter('Skynettechnologies\\Allinoneaccessibility\\Property\\TypeConverter\\ObjectStorageConverter');
