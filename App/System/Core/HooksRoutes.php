<?php
namespace System\Core;

use System\Libraries\Lang;
use System\Response;
use System\ResponseType;

class HooksRoutes {
    private static $instance = null;

    public function __construct(){
        self::$instance = $this;
    }

    public static function getInstance(){
        if (is_null(self::$instance)){
            self::$instance = new HooksRoutes();
        }
        return self::$instance;
    }

    public function apiErrorCallJson($msg, $responseCode = 200){
        $Data = [];
        $Data['responseCode'] = $responseCode;
        $Data['response'] = null;
        $Data['hasError'] = true;
        $Data['message'] = $msg;
        $Data['time'] = time();
        return json_encode($Data);
    }

    public function apiSuccessCallJson($data, $msg = "", $responseCode = 200){
        $Data = [];
        $Data['responseCode'] = $responseCode;
        $Data['response'] = $data;
        $Data['hasError'] = false;
        $Data['message'] = $msg;
        $Data['time'] = time();
        return json_encode($Data);
    }


    /**
     * @param $msg
     * @throws null
     */
    public function onCallError($msg){
        $Header = Response::getInstance()->getResponseHeader("Content-Type");
        if ($Header == ResponseType::CONTENT_JSON){
            echo $this->apiErrorCallJson($msg);
            exit();
        }else{
            throw new \Exception($msg, 99);
        }
    }

    public function onCallSuccess($msg){
        $Header = Response::getInstance()->getResponseHeader("Content-Type");
        if ($Header == ResponseType::CONTENT_JSON){
            return $this->apiSuccessCallJson([], $msg, 200);
        }else{
            return $msg;
        }
    }

    public function onNotFound(){
        global $Config;
        Response::getInstance()->setHeader("Content-Type: ".$Config['error_content_type']);
        foreach ($Config['error_extra_headers'] as $header){
            Response::getInstance()->setHeader($header);
        }
        if ($Config['error_content_type'] == ResponseType::CONTENT_JSON){
            echo HooksRoutes::apiErrorCallJson(Lang::get("error404"), 404);
            exit();
        }else{
            DefaultErrors::getInstance()->Error404();
        }
    }

}