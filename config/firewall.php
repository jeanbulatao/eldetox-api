<?php

return [
    'origin' => [
        env('FIREWALL_ORIGIN_WEB', 'WEB-80124'),
        env('FIREWALL_ORIGIN_MOBILE', 'MOBILE-14672'),
        env('FIREWALL_ORIGIN_POSTMAN', 'POSTMAN-00000'),
    ],
    'logging' => env('FIREWALL_LOGGING', true)
];
