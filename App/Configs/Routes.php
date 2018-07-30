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

$Routes['Login'] = [
    'Controller' => "\\Controller\\Index",
    "Method" => "Login",
    'Type' => \System\Response::GET,
    'Headers' => [],
    'RequireHeader' => []
];
