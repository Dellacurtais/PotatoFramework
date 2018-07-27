<?php
$Routes = array();


$Routes['NotFound'] = [
    'Controller' => "\\Controller\\Error",
    "Method" => "NotFound",
    'Type' => "GET",  //GET|POST|PUT|DELETE|ALL
    'Headers' => [
        "HTTP/1.0 404 Not Found"
    ],
    'RequireHeader' => []
];

/**
 * Rotas do sistema
 */
$Routes['Login'] = [
    'Controller' => "\\Controller\\Index",
    "Method" => "Login",
    'Type' => "GET",
    'Headers' => [],
    'RequireHeader' => []
];


