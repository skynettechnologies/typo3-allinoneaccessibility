<?php
defined('TYPO3_MODE') || die();

/***************
 * Add default RTE configuration
 */
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['allinoneaccessibility'] = 'EXT:allinoneaccessibility/Configuration/RTE/Default.yaml';



$signalSlotDispatcher = TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\SignalSlot\Dispatcher::class);
$signalSlotDispatcher->connect(
        \TYPO3\CMS\Extensionmanager\Utility\InstallUtility::class,  // Signal class name
        'afterExtensionUninstall',
        \Allinone\Allinoneaccessibility\Hooks\AppMethods::class,
        'removeApp'
);

$signalSlotDispatcher->connect(
        \TYPO3\CMS\Extensionmanager\Utility\InstallUtility::class,  // Signal class name
        'afterExtensionInstall',
        \Allinone\Allinoneaccessibility\Hooks\AppMethods::class,
        'addApp'
);

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Allinone.Allinoneaccessibility',
            'Ajaxmap',
            [
                \Allinone\Allinoneaccessibility\Controller\PostController::class => 'main'
            ],
            // non-cacheable actions
            [
                \Allinone\Allinoneaccessibility\Controller\PostController::class => 'main'
            ]
        );

    }
);
