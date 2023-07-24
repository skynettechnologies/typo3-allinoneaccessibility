<?php

return [
    'Sntg_module' => [
        'labels' => 'LLL:EXT:allinone_accessibility/Resources/Private/Language/BackendModule.xlf',
        'icon' => 'EXT:allinone_accessibility/Resources/Public/Icons/module-allinoneaccessibility.svg',
        'iconIdentifier' => 'module-allinoneaccessibility',
        'navigationComponent' => '@typo3/backend/page-tree/page-tree-element',
        'position' => ['after' => 'web'],
    ],
    'Sntg_AllinoneAccessibilityToolmodule' => [
        'parent' => 'Sntg_module',
        'position' => ['before' => 'top'],
        'access' => 'admin,user,group',
        'path' => '/module/Sntg/AllinoneAccessibilityToolmodule',
        'icon'   => 'EXT:allinone_accessibility/Resources/Public/Icons/whats_app.svg',
        'labels' => 'LLL:EXT:allinone_accessibility/Resources/Private/Language/locallang_whastappmodule.xlf',
        'navigationComponent' => '@typo3/backend/page-tree/page-tree-element',
        'extensionName' => 'AllinoneAccessibility',
        'controllerActions' => [
            \Sntg\AllinoneAccessibility\Controller\ToolController::class => [
                'chatSettings', 
            ],
        ],
    ],
    
];

?>