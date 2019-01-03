<?php
if (!function_exists('handler_exception')) {
    /**
     * Handler Error
     * @param $errno
     * @param $errstr
     * @param $errfile
     * @param $errline
     */

    function handler_error($errno, $errstr, $errfile, $errline){
        \System\Core\DefaultErrors::getInstance()->handlerError($errno, $errstr, $errfile, $errline);
    }
}

if (!function_exists('handler_exception')) {
    /**
     * Handler Error
     * @param Exception $Execption
     */
    function handler_exception($Execption){
        \System\Core\DefaultErrors::getInstance()->ErrorXXX($Execption->getCode(), $Execption);
    }
}

if (!function_exists('shutdownHandler')) {
    /**
     * Handler Parse Error
     */
    function shutdownHandler(){
        $lasterror = error_get_last();
        switch ($lasterror['type']) {
            case E_ERROR:
            case E_CORE_ERROR:
            case E_COMPILE_ERROR:
            case E_USER_ERROR:
            case E_RECOVERABLE_ERROR:
            case E_CORE_WARNING:
            case E_COMPILE_WARNING:
            case E_PARSE:
                handler_error($lasterror['type'], $lasterror['message'], $lasterror['file'], $lasterror['line']);
        }
    }
}

if (!function_exists('loaderFastApp')) {
    /**
     * Autoload Class
     * @param $class
     */
    function loaderFastApp($class){
        $filename = BASE_PATH . DIRECTORY_SEPARATOR . str_replace('\\', '/', $class) . '.php';
        $filename = str_replace("//", "/", $filename);

        if (file_exists($filename)) {
            require_once($filename);
        } else {
            $filename = BASE_PATH_THIRD . DIRECTORY_SEPARATOR . str_replace('\\', '/', $class) . '.php';
            if (file_exists($filename)) {
                require_once($filename);
            }
        }
    }
}

if (!function_exists('getJsonPost')) {
    /**
     * Obter dados em JSON envidos bo Body de um requisição
     * @return mixed
     */
    function getJsonPost(){
        return json_decode(file_get_contents('php://input'), 1);
    }
}

if (!function_exists('getallheaders')) {
    /**
     * Obter todos os cabeçalhos passados na requisição
     * @return array
     */
    function getallheaders(){
        $headers = array();
        $copy_server = array(
            'CONTENT_TYPE'   => 'Content-Type',
            'CONTENT_LENGTH' => 'Content-Length',
            'CONTENT_MD5'    => 'Content-Md5',
        );
        foreach ($_SERVER as $key => $value) {
            if (substr($key, 0, 5) === 'HTTP_') {
                $key = substr($key, 5);
                if (!isset($copy_server[$key]) || !isset($_SERVER[$key])) {
                    $key = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', $key))));
                    $headers[$key] = $value;
                }
            } elseif (isset($copy_server[$key])) {
                $headers[$copy_server[$key]] = $value;
            }
        }
        if (!isset($headers['Authorization'])) {
            if (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
                $headers['Authorization'] = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
            } elseif (isset($_SERVER['PHP_AUTH_USER'])) {
                $basic_pass = isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : '';
                $headers['Authorization'] = 'Basic ' . base64_encode($_SERVER['PHP_AUTH_USER'] . ':' . $basic_pass);
            } elseif (isset($_SERVER['PHP_AUTH_DIGEST'])) {
                $headers['Authorization'] = $_SERVER['PHP_AUTH_DIGEST'];
            }
        }
        return $headers;
    }
}