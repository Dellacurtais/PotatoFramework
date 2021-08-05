<?php
namespace System;

class Request {

    protected static $instance = null;

    protected $allHeaders;
    protected static $paramJson = null;

    const GET = "GET";
    const POST = "POST";
    const REQUEST = "REQUEST";
    const JSON = "JSON";
    const EXTRA = "EXTRA";

    protected static $extra;

    /**
     * Obter instancia da class
     * @return null|Request
     */
    public static function getInstance(){
        if (is_null(self::$instance)){
            self::$instance = new Request();
        }
        return self::$instance;
    }

    /**
     * Response constructor.
     */
    public function __construct(){
        self::$paramJson = getJsonPost();
        $this->allHeaders = getallheaders();
    }

    /**
     * XSS clear
     */
    public static function xssClear(){
        $_GET   = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    }

    /**
     * Obter parametro _GET
     * @param $key
     * @param int $xss
     * @return mixed|null
     */
    public static function get($key, $xss = 0){
        if (!isset($_GET[$key]))
            return null;

        if ($xss)
            return filter_input(INPUT_GET, $key, FILTER_SANITIZE_STRING);
        return $_GET[$key];
    }

    /**
     * Obter parametro _GET com valor default
     * @param $key
     * @param $defult
     * @return mixed
     */
    public static function getDefault($key, $defult){
        if (!isset($_GET[$key]))
            return $defult;
        return $_GET[$key];
    }

    /**
     * Obter parametro _POST
     * @param $key
     * @param int $xss
     * @return mixed|null
     */
    public static function post($key, $xss = 0){
        if (!isset($_POST[$key]))
            return null;

        if ($xss)
            return filter_input(INPUT_POST, $key, FILTER_SANITIZE_STRING);

        return $_POST[$key];
    }

    /**
     * Obter paramento _POST com valor default
     * @param $key
     * @param $default
     * @return mixed
     */
    public static function postDefault($key, $default){
        if (!isset($_POST[$key]))
            return $default;

        return $_POST[$key];
    }

    /**
     * Obter parametro em JSON (Se passo por BODY em um requisição)
     * @param null $key
     * @param int $xss
     * @return mixed|null
     */
    public static function json($key = null, $xss = 0){
        if ($key == null){
            return self::$paramJson;
        }
        if (!isset(self::$paramJson[$key]))
            return null;

        if ($xss)
            return filter_var(self::$paramJson[$key], FILTER_SANITIZE_STRING);

        return self::$paramJson[$key];
    }

    /**
     * Obter parametros da requisição
     * @param $key
     * @param int $xss
     * @return mixed|null
     */
    public static function request($key = null, $xss = 0){
        if (is_null($key)){
            return $_REQUEST;
        }

        if (!isset($_REQUEST[$key]))
            return null;

        if ($xss)
            return filter_input(INPUT_REQUEST, $key, FILTER_SANITIZE_STRING);

        return $_REQUEST[$key];
    }

    /**
     * Obter parametros extras setados manualmente
     * @param null $key
     * @return mixed
     */
    public static function extra($key = null){
        if ($key == null){
            return self::$extra;
        }
        return self::$extra[$key];
    }

    /**
     * Definir parametros extras
     * @param $array
     */
    public static function setExtra($array){
        self::$extra = $array;
    }

    /**
     * Verifica em todos os paramêtos e retorna o que achar primeiro
     * @param $key string
     * @return mixed
     */
    public static function find($key){
        if (is_null($key))
            return null;

        if (isset($_GET[$key]))
            return filter_var($_GET[$key], FILTER_SANITIZE_STRING);

        if (isset($_POST[$key]))
            return filter_var($_POST[$key], FILTER_SANITIZE_STRING);

        if (isset(self::$paramJson[$key]))
            return self::$paramJson[$key];

        if (isset(self::$extra[$key]))
            return self::$extra[$key];

        if (isset($_REQUEST[$key]))
            return filter_var($_REQUEST[$key], FILTER_SANITIZE_STRING);

        return null;
    }

    /**
     * Obter um cabeçalho especifico passado na requisição
     * @param null $key
     * @return array|false|null
     */
    public function getHeader($key = null){
        if ($key == null){
            return $this->allHeaders;
        }

        if (isset($this->allHeaders[$key]))
            return $this->allHeaders[$key];

        return null;
    }

    public function __get($key){
        return self::find($key);
    }

}