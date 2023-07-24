<?php

return [
    'frontend' => [
        'Allinoneaccessibility-frontend' => [
            'target' => \Sntg\AllinoneAccessibility\Middleware\AwesomeMiddleware::class,
            'after' => [
                'typo3/cms-frontend/prepare-tsfe-rendering',
            ],
        ]
    ]
];
