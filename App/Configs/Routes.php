<?php
$Routes = array();

$Routes['NotFound'] = [
    'Controller' => "\\Controller\\Error",
    "Method" => "NotFound",
    'Type' => \System\Response::GET,  //GET|POST|PUT|DELETE|ALL
    'Headers' => [
        "HTTP/1.0 404 Not Found"
    ],
    'RequireHeader' => []
];

/**
 * Rotas do sistema
 */

$Routes['Home'] = [
    'Controller' => "\\Controller\\Index",
    "Method" => "Home",
    'Type' => \System\Response::GET,
    'Headers' => [],
    'RequireHeader' => []
];
