<?php
$Routes = array();


$Routes['NotFound'] = [
    'Controller' => "\\Controller\\Error",
    "Method" => "NotFound",
    'Type' => "GET",
    'Headers' => [
        "HTTP/1.0 404 Not Found"
    ],
    'RequireHeader' => []
];

$Routes['Home'] = [
    'Controller' => "\\Controller\\Index",
    "Method" => "Home",
    'Type' => "GET", //GET|POST|PUT|DELETE|ALL
    'Headers' => [
        "Batata-Frita: teste"
    ],
    'RequireHeader' => [
    ]
];


