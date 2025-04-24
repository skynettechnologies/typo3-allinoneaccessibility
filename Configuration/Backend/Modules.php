<?php

return [
    'Sntg_module' => [
        'labels' => 'LLL:EXT:allinoneaccessibility/Resources/Private/Language/BackendModule.xlf',
        'icon' => 'EXT:allinoneaccessibility/Resources/Public/Icons/module-allinoneaccessibility.svg',
        'iconIdentifier' => 'module-allinoneaccessibility',
        'navigationComponent' => '@typo3/backend/page-tree/page-tree-element',
        'position' => ['after' => 'web'],
    ],
    'Sntg_AllinoneaccessibilityToolmodule' => [
        'parent' => 'Sntg_module',
        'position' => ['before' => 'top'],
        'access' => 'admin,user,group',
        'path' => '/module/Skynettechnologies/AllinoneaccessibilityToolmodule',
        'icon'   => 'EXT:allinoneaccessibility/Resources/Public/Icons/whats_app.svg',
        'labels' => 'LLL:EXT:allinoneaccessibility/Resources/Private/Language/locallang_whastappmodule.xlf',
        'navigationComponent' => '@typo3/backend/page-tree/page-tree-element',
        'extensionName' => 'Allinoneaccessibility',
        'controllerActions' => [
            \Skynettechnologies\Allinoneaccessibility\Controller\ToolController::class => [
                'chatSettings', 
            ],
        ],
    ],
    
];

?>