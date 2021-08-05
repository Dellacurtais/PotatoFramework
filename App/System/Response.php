<?php
namespace System;

use System\Libraries\View;
use System\ResponseType as ResponseType;

class Response {

    protected static $instance = null;
    protected $responseHeader = [];
    protected $controller = null;

    const ALL = "ALL";
    const GET = "GET";
    const POST = "POST";
    const PUT = "PUT";
    const DELETE = "DELETE";
    const PATCH = "PATCH";
    const OPTIONS = "OPTIONS";
    const HEAD = "HEAD";

    /**
     * Obter instancia da class
     * @return null|Response
     */
    public static function getInstance(){
        if (is_null(self::$instance)){
            self::$instance = new Response();
        }
        return self::$instance;
    }

    /**
     * @param \System\Core\Controller $controller
     */
    public function setController($controller){
        $this->controller = $controller;
    }

    /**
     * @param \System\Core\Controller $controller
     */
    public function getController(){
        return $this->controller;
    }

    /**
     * Setar um cabeçalho para requisição atual
     * @param $key
     * @param null $value
     */
    public function setHeader($key,$value = null){
        if (is_null($value)) {
            $Get = explode(":", $key);
            $this->responseHeader[$Get[0]] = isset($Get[1]) ? $Get[1] : null;
            header($key);
        }else{
            $this->responseHeader[$key] = $value;
            header("{$key}:{$value}");
        }
    }

    /**
     * Obter um cabeçalho para requisição atual
     * @param $key
     * @return mixed
     */
    public function getResponseHeader($key){
        return $this->responseHeader[$key];
    }

    /**
     * Definir o tipo do conteudo da página
     * @param $type
     */
    public function setHeaderType($type){
        $this->setHeader("Content-Type", $type);
    }

    /**
     * @return \System\Libraries\ViewJson
     */
    public function json(){
        $this->setHeaderType(ResponseType::CONTENT_JSON);
        return View::getJson();
    }

    /**
     * @return \System\Libraries\ViewHtml
     */
    public function html(){
        $this->setHeaderType(ResponseType::CONTENT_HTML);
        return View::getHtml();
    }

    /**
     * Get Default HTML
     * @param array $Merge Extra Headers
     * @return array
     */
    public static function getDefaultHtml($Merge = []){
        return array_merge($Merge, [
            "Content-Type:".ResponseType::CONTENT_HTML,
        ]);
    }

    /**
     * Get Default JSON
     * @param array $Merge Extra Headers
     * @return array
     */
    public static function getDefaultJson($Merge = []){
        return array_merge($Merge, [
            "Content-Type:".ResponseType::CONTENT_JSON,
        ]);
    }

    /**
     * Get Default JS
     * @param array $Merge Extra Headers
     * @return array
     */
    public static function getDefaultJs($Merge = []){
        return array_merge($Merge, [
            "Content-Type:".ResponseType::CONTENT_JS,
        ]);
    }

    /**
     * Get Default CSS
     * @param array $Merge Extra Headers
     * @return array
     */
    public static function getDefaultCss($Merge = []){
        return array_merge($Merge, [
            "Content-Type:".ResponseType::CONTENT_CSS,
        ]);
    }

    /**
     * Get Default XML
     * @param array $Merge Extra Headers
     * @return array
     */
    public static function getDefaultXml($Merge = []){
        return array_merge($Merge, [
            "Content-Type:".ResponseType::CONTENT_XML,
        ]);
    }

    /**
     * Get Default OctetStream
     * @param array $Merge Extra Headers
     * @return array
     */
    public static function getDefaultOctetStream($Merge = []){
        return array_merge($Merge, [
            "Content-Type:".ResponseType::CONTENT_OCTETSTREAM,
        ]);
    }
}