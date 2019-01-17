<?php
define("ENVIRONMENT", "development"); //production, development
define("ROOT_PATH", __DIR__);
define("BASE_PATH", __DIR__."/App/");
define("BASE_PATH_CACHE", __DIR__."/App/Cache/");
define("BASE_PATH_THIRD", __DIR__."/App/Third/");
define("BASE_PATH_MODELS", __DIR__."/App/Models/");
define("BASE_PATH_VIEWS", __DIR__."/App/Views/");

define("TEMPLATE_ENGINE_SMARTY","smarty");
define("TEMPLATE_WITHOUT_ENGINE","without");

switch (ENVIRONMENT){
    case 'development':
        error_reporting(-1);
        ini_set('display_errors', 1);
        break;
    case 'testing':
    case 'production':
        ini_set('display_errors', 0);
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
        break;
    default:
        header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
        echo 'The application environment is not set correctly.';
        exit(1);
}

require_once "App/System/Core/Functions/DefaultFunctions.php";
set_error_handler("handler_error");
set_exception_handler('handler_exception');
spl_autoload_register('loaderFastApp');
register_shutdown_function("shutdownHandler");

require_once "App/Configs/Config.php";

date_default_timezone_set($Config['timezone']);

$App = new \System\FastApp();
