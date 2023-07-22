<?php

return [
    'frontend' => [
        'Allinoneaccessibility-frontend' => [
            'target' => \Allinone\Allinoneaccessibility\Middleware\AwesomeMiddleware::class,
            'after' => [
                'typo3/cms-frontend/prepare-tsfe-rendering',
            ],
        ]
    ]
];
