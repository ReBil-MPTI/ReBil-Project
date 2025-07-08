<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie', 'livewire/upload-file'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['https://rebil-project-production.up.railway.app'],
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true,
];

