<?php
use \System\Core\Routes;
use \System\ResponseType;
use \Controller\Index;

Routes::get('Home', [
    'Controller' => Index::class,
    "Method" => "Index",
    'Headers' => [
        "Content-Type:".ResponseType::CONTENT_HTML
    ],
    'RequireHeader' => [],
    'onCallBefore' => [],
    'onCallAfter' => [],
    'onCallFinish' => []
]);