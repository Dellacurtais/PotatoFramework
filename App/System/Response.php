<?php
namespace System;

class Response {

    protected static $instance = null;
    protected $responseHeader = [];

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
     * Criar json simples para requisições ajax, api, etc...
     * @param $msg
     * @param null $data
     * @param bool $response
     * @return false|string
     */
    public function encodeJson($msg, $data = null, $response = false){
        return json_encode(["msg" => $msg, "data" => $data, "responseError" => $response]);
    }
}