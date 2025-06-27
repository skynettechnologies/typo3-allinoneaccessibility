<?php
defined('TYPO3') || die('Access denied.');

define('BASE_DIR', basename(__DIR__));


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
            ['source' => 'EXT:typo3_allinoneaccessibility/Resources/Public/Icons/user_plugin_whatsapp.svg']
        );

        $iconRegistry->registerIcon(
            'module-Allinoneaccessibility',
            \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            ['source' => 'EXT:typo3_allinoneaccessibility/Resources/Public/Icons/module-sntg.svg']
        );

        $GLOBALS['TYPO3_CONF_VARS']['BE']['contentSecurityPolicyHeader'] = "
                default-src 'self';
                script-src 'self' 'unsafe-inline' http://gc.kis.v2.scr.kaspersky-labs.com;
                style-src 'self' 'unsafe-inline';
                frame-src 'self' https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3671.933221972849!2d72.50650967584109!3d23.02579601625902!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd697%3A0x4ed22f17ad63e129!2sSabarmati%20Ashram!5e0!3m2!1sen!2sin!4v1719216954204!5m2!1sen!2sin;
            ";


        $GLOBALS['TYPO3_CONF_VARS']['SYS']['features']['security.backend.enforceContentSecurityPolicy'] = false;
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['features']['security.frontend.enforceContentSecurityPolicy'] = false;
    }
);
