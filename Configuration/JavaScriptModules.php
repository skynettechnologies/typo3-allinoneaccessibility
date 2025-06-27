<?php

return [
    // required import configurations of other extensions,
    // in case a module imports from another package
    'dependencies' => ['backend'],
    'imports' => [
        // recursive definiton, all *.js files in this folder are import-mapped
        // trailing slash is required per importmap-specification
        '@Skynettechnologies/allinoneaccessibility/' => 'EXT:typo3_allinoneaccessibility/Resources/Public/JavaScript/',
    ],
];
