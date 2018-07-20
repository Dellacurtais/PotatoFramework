<?php
$Routes = array();

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


