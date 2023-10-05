<?php

return [
    'frontend' => [
        'Typo3Allinoneaccessibility-frontend' => [
            'target' => \Skynettechnologies\Typo3Allinoneaccessibility\Middleware\AwesomeMiddleware::class,
            'after' => [
                'typo3/cms-frontend/prepare-tsfe-rendering',
            ],
        ]
    ]
];
