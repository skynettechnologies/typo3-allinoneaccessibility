<?php
defined('TYPO3') || die('Access denied.');

call_user_func(
    function () {
        
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Allinoneaccessibility',
            'Tool',
            [
                \Skynettechnologies\Allinoneaccessibility\Controller\ToolController::class => 'main',
            ],
            // non-cacheable actions
            [
                \Skynettechnologies\Allinoneaccessibility\Controller\ToolController::class => 'main',
            ]
        );

        $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);

        $iconRegistry->registerIcon(
            'allinone-plugin-tool',
            \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            ['source' => 'EXT:allinoneaccessibility/Resources/Public/Icons/user_plugin_whatsapp.svg']
        );

        $iconRegistry->registerIcon(
            'module-Allinoneaccessibility',
            \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            ['source' => 'EXT:allinoneaccessibility/Resources/Public/Icons/module-sntg.svg']
        );

        $GLOBALS['TYPO3_CONF_VARS']['SYS']['features']['security.backend.enforceContentSecurityPolicy'] = false;
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['features']['security.frontend.enforceContentSecurityPolicy'] = false;    
    }
);