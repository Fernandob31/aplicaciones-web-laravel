<?php

return [
    'paths' => ['api/*'],
    'allowed_methods' => ['*'],     // Cambiar al despplegar producion
    'allowed_origins' => ['*'],
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];