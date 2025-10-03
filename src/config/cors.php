<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie', 'auth/*'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['http://localhost:3000'],
    'allowed_headers' => ['Content-Type','X-Requested-With','Accept','Origin','Authorization','X-XSRF-TOKEN'],
    'supports_credentials' => true,
  ];