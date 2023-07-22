<?php
defined('TYPO3_MODE') || die();

(function(){
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
       'Allinone.Allinoneaccessibility', // Vendor dot Extension Name in CamelCase
       'web', // the main module
       'Allinoneaccessibility', // Submodule key
       'bottom', // Position
       [
           //'Post' => 'main',
           \Allinone\Allinoneaccessibility\Controller\PostController::class => 'main',
       ],
       [
           'access' => 'admin',
           'icon'   => 'EXT:allinoneaccessibility/Resources/Public/Icons/favicon.png',
           'labels' => 'LLL:EXT:allinoneaccessibility/Resources/Private/Language/locallang.xlf',
           'navigationComponentId' => '',
           'inheritNavigationComponentFromMainModule' => false
       ]
    );

})();
