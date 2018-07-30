<?php
$DynamicRoutes = [];

/**
 * Exemplo
 */
$DynamicRoutes['View/:num'] = [
    'Controller' => "\\Controller\\Index\\",
    "Method" => "Home",
    'Type' => \System\Response::GET,
    'Headers' => [],
    'RequireHeader' => []
];

