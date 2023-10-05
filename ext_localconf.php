<?php
defined('TYPO3') || die('Access denied.');

call_user_func(
    function () {
        
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Typo3Allinoneaccessibility',
            'Tool',
            [
                \Skynettechnologies\Typo3Allinoneaccessibility\Controller\ToolController::class => 'main',
            ],
            // non-cacheable actions
            [
                \Skynettechnologies\Typo3Allinoneaccessibility\Controller\ToolController::class => 'main',
            ]
        );

        $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);

        $iconRegistry->registerIcon(
            'ns_whatsapp-plugin-whatsapp',
            \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            ['source' => 'EXT:typo3_allinoneaccessibility/Resources/Public/Icons/user_plugin_whatsapp.svg']
        );

        $iconRegistry->registerIcon(
            'module-typo3allinoneaccessibility',
            \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            ['source' => 'EXT:typo3_allinoneaccessibility/Resources/Public/Icons/module-sntg.svg']
        );

        $GLOBALS['TYPO3_CONF_VARS']['SYS']['features']['security.backend.enforceContentSecurityPolicy'] = false;
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['features']['security.frontend.enforceContentSecurityPolicy'] = false;    
    }
);