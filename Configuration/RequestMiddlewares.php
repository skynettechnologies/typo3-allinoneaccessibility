<?php

return [
    'frontend' => [
        'Allinoneaccessibility-frontend' => [
            'target' => \Skynettechnologies\Allinoneaccessibility\Middleware\AwesomeMiddleware::class,
            'after' => [
                'typo3/cms-frontend/prepare-tsfe-rendering',
            ],
        ]
    ]
];
