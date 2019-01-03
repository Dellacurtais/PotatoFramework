<?php

\System\Core\Routes::get('Welcome', [
    'Controller' => \Controller\Index::class,
    "Method" => "Index",
    'Headers' => [
        "Content-Type:".\System\ResponseType::CONTENT_HTML,
    ],
    'RequireHeader' => [],
    'onCallBefore' => [],
    'onCallAfter' => [],
    'onCallFinish' => []
]);