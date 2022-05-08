<?php

return [
    'user_id' => env('CLOCKIFY_USER_ID', null),
    'base_url' => env('CLOCKIFY_BASE_URL', 'https://api.clockify.me/api/v1'),
    'api_key' => env('CLOCKIFY_API_KEY', null),
    'workspace' => env('CLOCKIFY_WORKSPACE', null)
];
