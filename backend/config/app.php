<?php

return [
    'APP_URL'=>env('APP_URL'),
    'key' => env('APP_KEY'),
    'cipher' => env('APP_CIPHER','AES-256-CBC'),
    'PAGE_LIMIT'=>10,
    'debug' => env('APP_DEBUG', false)
];