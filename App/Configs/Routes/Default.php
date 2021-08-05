<?php
use \System\Core\Routes;
use System\Request;
use \System\ResponseType;
use \Controller\Index;
use \System\Response;

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

/**
 * Example
 */
Routes::get("find/{id}", [ 'Controller' => Index::class, "Method" => "FindExample" ]);