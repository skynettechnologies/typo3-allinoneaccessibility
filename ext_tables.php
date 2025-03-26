<?php
// TYPO3 Security Check
defined('TYPO3_MODE') or die();

$_EXTKEY = $GLOBALS['_EXTKEY'] = 'allinoneaccessibility';

//Add Modules
if (TYPO3_MODE === 'BE') {
    $isVersion9Up = \TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionNumberToInteger(TYPO3_version) >= 9000000;

    if (version_compare(TYPO3_branch, '8.0', '>=')) {

        // Add module 'skynettechnologies' after 'Web'
        if (!isset($GLOBALS['TBE_MODULES']['skynettechnologies'])) {
            $temp_TBE_MODULES = [];
            foreach ($GLOBALS['TBE_MODULES'] as $key => $val) {
                if ($key == 'web') {
                    $temp_TBE_MODULES[$key] = $val;
                    $temp_TBE_MODULES['skynettechnologies'] = '';
                } else {
                    $temp_TBE_MODULES[$key] = $val;
                }
            }
            $GLOBALS['TBE_MODULES'] = $temp_TBE_MODULES;
            $GLOBALS['TBE_MODULES']['_configuration']['skynettechnologies'] = [
                'iconIdentifier' => 'module-allinoneaccessibility',
                'labels' => 'LLL:EXT:allinoneaccessibility/Resources/Private/Language/BackendModule.xlf',
                'name' => 'skynettechnologies',
            ];
        }
        
        if (version_compare(TYPO3_branch, '11.0', '>=')) {
            $moduleClass = \Skynettechnologies\Allinoneaccessibility\Controller\ToolController::class;
        } else {
            $moduleClass = 'Tool';
        }
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
            'Skynettechnologies.Allinoneaccessibility',
            'skynettechnologies', // Make module a submodule of 'skynettechnologies'
            'toolmodule', // Submodule key
            '', // Position
            [
                $moduleClass => 'widgetSettings',
            ],
            [
                'access' => 'user,group',
                'icon' => 'EXT:allinoneaccessibility/Resources/Public/Icons/whats_app.svg',
                'labels' => 'LLL:EXT:allinoneaccessibility/Resources/Private/Language/locallang_whastappmodule.xlf',
                'navigationComponentId' => ($isVersion9Up ? 'TYPO3/CMS/Backend/PageTree/PageTreeElement' : 'typo3-pagetree'),
                'inheritNavigationComponentFromMainModule' => false,
            ]
        );
    }
}
