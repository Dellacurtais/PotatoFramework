<?php
use \System\Core\Routes as Routes;
use \System\ResponseType as ResponseType;
use \Controller\Index as Index;

Routes::get('Welcome', [
    'Controller' => Index::class,
    "Method" => "Index",
    'Headers' => [
        "Content-Type:".ResponseType::CONTENT_HTML,
    ],
    'RequireHeader' => [],
    'onCallBefore' => [],
    'onCallAfter' => [],
    'onCallFinish' => []
]);