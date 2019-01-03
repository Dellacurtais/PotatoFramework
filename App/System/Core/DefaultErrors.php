<?php
namespace System\Core;

use System\Libraries\Lang;
use System\Libraries\Smarty;
use System\Response;
use System\ResponseType;

class DefaultErrors {

    protected static $instance;

    public static function getInstance(){
        if (is_null(self::$instance)){
            self::$instance = new DefaultErrors();
        }
        return self::$instance;
    }

    public function handlerError($errno = null, $errstr = null, $errfile = null, $errline = null){
        global $Config;

        if ($Config['error_content_type'] == ResponseType::CONTENT_JSON){
            Response::getInstance()->setHeaderType(ResponseType::CONTENT_JSON);
            echo HooksRoutes::getInstance()->apiErrorCallJson($errstr." File: ".$errfile." Line: ".$errline, $errno);
            return;
        }

        Smarty::getInstance()->view("Error/ErrorHandler.tpl", [
            "number" => $errno,
            "error" => $errstr,
            "file" => $errfile,
            "line" => $errline
        ]);
    }

    public function Error404(){
        global $Config;
        Response::getInstance()->setHeader("HTTP/1.0 404 Not Found");
        Response::getInstance()->setHeader("Content-Type:".$Config['error_content_type']);

        if ($Config['error_content_type'] == ResponseType::CONTENT_JSON){
            echo HooksRoutes::getInstance()->apiErrorCallJson(Lang::getInstance()->line("error404"), 404);
            exit();
        }

        Smarty::getInstance()->view("Error/Error404.tpl");
        exit();
    }

    /**
     * @param $Code
     * @param $Exception \Exception
     */
    public function ErrorXXX($Code, $Exception){
        global $Config;
        Response::getInstance()->setHeader("HTTP/1.0 {$Code}");
        Response::getInstance()->setHeader("Content-Type:".$Config['error_content_type']);

        if ($Config['error_content_type'] == ResponseType::CONTENT_JSON){
            echo HooksRoutes::getInstance()->apiErrorCallJson($Exception->getMessage()." File: ".$Exception->getFile()." Line: ".$Exception->getLine(), $Exception->getCode());
            exit();
        }

        Smarty::getInstance()->view("Error/ErrorXXX.tpl", [ "Excpetion" => $Exception ]);
        exit();
    }
}