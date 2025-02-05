<?php

return [
    "service_name" => env('PLANFACT_PROJECT_NAME', 'Planfact'),
    "url" => env('PLANFACT_URL', 'https://api.planfact.io'),
    "timeout" => env('PLANFACT_TIMEOUT', 30),
    "connection_timeout" => env('PLANFACT_CONNECTION_TIMEOUT', 5),
    "api_key" => env('PLANFACT_API_KEY'),
];