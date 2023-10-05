<?php

return [
    'Sntg_module' => [
        'labels' => 'LLL:EXT:typo3_allinoneaccessibility/Resources/Private/Language/BackendModule.xlf',
        'icon' => 'EXT:typo3_allinoneaccessibility/Resources/Public/Icons/module-typo3allinoneaccessibility.svg',
        'iconIdentifier' => 'module-typo3allinoneaccessibility',
        'navigationComponent' => '@typo3/backend/page-tree/page-tree-element',
        'position' => ['after' => 'web'],
    ],
    'Sntg_Typo3AllinoneaccessibilityToolmodule' => [
        'parent' => 'Sntg_module',
        'position' => ['before' => 'top'],
        'access' => 'admin,user,group',
        'path' => '/module/Skynettechnologies/Typo3AllinoneaccessibilityToolmodule',
        'icon'   => 'EXT:typo3_allinoneaccessibility/Resources/Public/Icons/whats_app.svg',
        'labels' => 'LLL:EXT:typo3_allinoneaccessibility/Resources/Private/Language/locallang_whastappmodule.xlf',
        'navigationComponent' => '@typo3/backend/page-tree/page-tree-element',
        'extensionName' => 'Typo3Allinoneaccessibility',
        'controllerActions' => [
            \Skynettechnologies\Typo3Allinoneaccessibility\Controller\ToolController::class => [
                'chatSettings', 
            ],
        ],
    ],
    
];

?>