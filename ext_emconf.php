<?php

/**
 * Extension Manager/Repository config file for ext "allinoneaccessibility.
 */
$EM_CONF[$_EXTKEY] = [
    'title' => 'All in One Accessibility',
    'description' => 'All in One Accessibility widget improves Typo3 website ADA compliance and browser experience for ADA, WCAG 2.1, Section 508, Australian DDA, European EAA EN 301 549, UK Equality Act (EA), Israeli Standard 5568, California Unruh, Ontario AODA, Canada ACA, German BITV, and France RGAA standards.',
    'category' => 'templates',
    'constraints' => [
        'depends' => [
            //'typo3' => '9.3.0-10.4.99'
            'typo3' => '11.0.0-11.5.99'
        ],
        'conflicts' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'Allinone\\Allinoneaccessibility\\' => 'Classes',
        ],
    ],
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author' => 'Skynet Technologies USA LLC',
    'author_email' => 'hello@skynettechnologies.com',
    'author_company' => 'Skynet Technologies USA LLC',
    'version' => '1.0.11',
];
