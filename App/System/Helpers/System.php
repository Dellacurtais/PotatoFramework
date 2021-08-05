<?php

if (!function_exists('redirect')){
    /**
     * Redirecionamento de página
     * By Codeigniter
     * @param string $uri url ou rota a redirecionar
     * @param string $method methodo do redirecionamento
     * @param int $code código do redirencionamento
     */
    function redirect($uri = '', $method = 'auto', $code = NULL){
        if ( ! preg_match('#^(\w+:)?//#i', $uri)) {
            $uri = base_url($uri);
        }
        if ($method === 'auto' && isset($_SERVER['SERVER_SOFTWARE']) && strpos($_SERVER['SERVER_SOFTWARE'], 'Microsoft-IIS') !== FALSE){
            $method = 'refresh';
        }elseif ($method !== 'refresh' && (empty($code) OR ! is_numeric($code))){
            if (isset($_SERVER['SERVER_PROTOCOL'], $_SERVER['REQUEST_METHOD']) && $_SERVER['SERVER_PROTOCOL'] === 'HTTP/1.1'){
                $code = ($_SERVER['REQUEST_METHOD'] !== 'GET')
                    ? 303
                    : 307;
            }else{
                $code = 302;
            }
        }
        switch ($method) {
            case 'refresh':
                header('Refresh:0;url='.$uri);
                break;
            default:
                header('Location: '.$uri, TRUE, $code);
                break;
        }
        exit;
    }
}

if (!function_exists("_uri_string")) {
    /**
     * Contruir query string
     * @param $uri
     * @return string
     */
    function _uri_string($uri){
        if (getConfig("enable_query_strings") === FALSE) {
            is_array($uri) && $uri = implode('/', $uri);
            return ltrim($uri, '/');
        } elseif (is_array($uri)) {
            return http_build_query($uri);
        }
        return $uri;
    }
}

if (!function_exists("base_url")) {
    /**
     * Obter url completa de uma rota
     * @param string $uri rota
     * @param null $protocol protocolo da rota Ex: http, https, ftp etc...
     * @return string url completa da rota
     */
    function base_url($uri = '', $protocol = NULL){
        $base_url = slash_item('base_url');
        if (isset($protocol)) {
            if ($protocol === '') {
                $base_url = substr($base_url, strpos($base_url, '//'));
            } else {
                $base_url = $protocol . substr($base_url, strpos($base_url, '://'));
            }
        }
        return $base_url._uri_string($uri);
    }
}

if (!function_exists("getQuery")) {
    /**
     * Obter todos os parametos passador por GET
     * @param array $removeKeys remover parametros especificos
     * @param bool $hasGet retornar com & se true ou ou ? se false
     * @return string query string
     */
    function getQuery($removeKeys = [], $hasGet = false){
        $Query = $_SERVER['QUERY_STRING'];
        parse_str($Query, $get_array);

        foreach ($removeKeys as $key) {
            if (isset($get_array[$key]))
                unset($get_array[$key]);
        }

        if ($hasGet)
            return "&" . http_build_query($get_array);

        return "?" . http_build_query($get_array);
    }
}

if (!function_exists("assets")) {
    /**
     * Carregar arquivos de layout na pasta setada nas configurações
     * @param $file String nome do arquivo desejado
     * @return string retorna url completa do arquivo
     */
    function assets($file){
        return base_url(getConfig("base_dir_assets").$file);
    }
}

if (!function_exists("slash_item")) {
    /**
     * @param $item
     * @return null|string
     */
    function slash_item($item){
        $Config = getConfig();
        if (!isset($Config[$item])){
            return NULL;
        }elseif (trim($Config[$item]) === ''){
            return '';
        }
        return rtrim($Config[$item], '/').'/';
    }
}

if (!function_exists("randomCode")) {
    /**
     * Gerar string aléatoria
     * @param int $tamanho tamanho da string que deseja gerar
     * @return string
     */
    function randomCode($tamanho = 8) {
        $retorno = '';
        $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $len = strlen($caracteres);
        for ($n = 1; $n <= $tamanho; $n++) {
            $rand = mt_rand(1, $len);
            $retorno .= str_shuffle($caracteres)[$rand-1];
        }
        return $retorno;
    }
}

if (!function_exists("dateToTime")) {
    /**
     * Converter formato de data para timestamp
     * @param $date String Data desejada
     * @param string $format Formato da data passada
     * @return bool|int
     */
    function dateToTime($date, $format = "YYYY-MM-DD"){
        if (strlen($date) != strlen($format))
            return 0;

        switch ($format) {
            case 'YYYY/MM/DD':
            case 'YYYY-MM-DD':
                list($y, $m, $d) = preg_split('/[-\.\/ ]/', $date);
                break;
            case 'YYYY/DD/MM':
            case 'YYYY-DD-MM':
                list($y, $d, $m) = preg_split('/[-\.\/ ]/', $date);
                break;
            case 'DD-MM-YYYY':
            case 'DD/MM/YYYY':
                list($d, $m, $y) = preg_split('/[-\.\/ ]/', $date);
                break;

            case 'MM-DD-YYYY':
            case 'MM/DD/YYYY':
                list($m, $d, $y) = preg_split('/[-\.\/ ]/', $date);
                break;

            case 'YYYYMMDD':
                $y = substr($date, 0, 4);
                $m = substr($date, 4, 2);
                $d = substr($date, 6, 2);
                break;

            case 'YYYYDDMM':
                $y = substr($date, 0, 4);
                $d = substr($date, 4, 2);
                $m = substr($date, 6, 2);
                break;
            default:
                return false;
        }
        return mktime(0, 0, 0, $m, $d, $y);
    }
}

if (!function_exists("str_replace_first")) {
    /**
     * Substituir primeira ocorrencia
     * @param $from
     * @param $to
     * @param $content
     * @return null|string|string[]
     */
    function str_replace_first($from, $to, $content){
        $from = '/' . preg_quote($from, '/') . '/';
        return preg_replace($from, $to, $content, 1);
    }
}

if (!function_exists('getConfig')){
    /**
     * Obter valor de Config especifica
     * @param $key
     * @return mixed
     */
    function getConfig($key = null){
        global $Config;
        if (is_null($key))
            return $Config;

        return $Config[$key];
    }
}

if (!function_exists('setConfig')){
    /**
     * Definir valor de Config especifica
     * @param $key
     * @return mixed
     */
    function setConfig($key, $value){
        global $Config;
        $Config[$key] = $value;
    }
}

if (!function_exists('apiSuccessCall')) {
    /**
     * Retorna um JSON de sucesso
     * @param $data
     * @param string $msg
     * @param int $code
     * @return false|string
     */
    function apiSuccessCall($data, $msg = '', $code = 200){
        return \System\Core\HooksRoutes::getInstance()->apiSuccessCallJson($data, $msg, $code);
    }
}

if (!function_exists('apiErrorCall')) {
    /**
     * Retorna um JSON de erro
     * @param $data
     * @param string $msg
     * @param int $code
     * @return false|string
     */
    function apiErrorCall($msg, $code = 404){
        return \System\Core\HooksRoutes::getInstance()->apiErrorCallJson($msg, $code);
    }
}

if (!function_exists('getDatetime')) {
    /**
     * Obter data no momento (Formato para MySQL)
     * @return false|string
     */
    function getDatetime(){
        return date("Y-m-d H:i:s");
    }
}

if (!function_exists('execute_callbacks')){
    function execute_callbacks($callback, $type){
        if (isset($callback[$type]) && !is_null($callback[$type])){
            if (is_array($callback[$type])){
                foreach ($callback[$type] as $callsback){
                    $onCallClass = $callsback[0];
                    $methodCall = $callsback[1];

                    $onCallInit = new $onCallClass();
                    $onCallInit->$methodCall($callback, $callsback);
                }
            }else {
                $callback[$type]($callback);
            }
        }
    }
}

if (!function_exists('execute_class')){
    function execute_class($class, $method, $attrs = []){
        if (class_exists($class)) {
            try {
                $verifyClass = new ReflectionClass($class);
                $totalParams = $verifyClass->getMethod($method)->getParameters();

                $finalAttrs = [];
                foreach ($totalParams as $parameter) {
                    $nameVar = $parameter->getName();
                    if (isset($attrs[$nameVar])){
                        $finalAttrs[] = $attrs[$nameVar];
                    }else{
                        switch ($nameVar){
                            case 'request':
                                $finalAttrs[] = \System\Request::getInstance();
                                break;
                            case 'response':
                                $finalAttrs[] = \System\Response::getInstance();
                                break;
                        }
                    }
                }

                $initClass = new $class();
                $Return = call_user_func_array([$initClass, $method], $finalAttrs);
                if ($Return instanceof \System\Libraries\View){
                    renderView($Return);
                }

                return true;
            } catch (ReflectionException $e) {

                return false;
            }
        }
        return false;
    }
}

if (!function_exists('getUriPatch')) {
    function getUriPatch(){
        $str = str_replace_first(getConfig('base_dir'), "", $_SERVER['REQUEST_URI']);
        $str = str_replace([$_SERVER['QUERY_STRING'], "?"], "", $str);
        return $str;
    }
}

if (!function_exists('loadFilesRoute')) {
    function loadFilesRoute(){
        $Routes = getConfig("files_route");
        foreach ($Routes as $file){
            if (file_exists($file)){
                include_once($file);
            }else if (file_exists(BASE_PATH."Configs/Routes/{$file}.php")) {
                include_once(BASE_PATH . "Configs/Routes/{$file}.php");
            }
        }
    }
}

if (!function_exists('addShortcode')){
    function addShortcode($name, $function){
        System\Libraries\Shortcode::getInstance()->addHandlers($name, $function);
    }
}

if (!function_exists('renderShortcode')){
    function renderShortcode($text){
        return System\Libraries\Shortcode::getInstance()->getProcessor($text);
    }
}

if (!function_exists('renderView')){
    function renderView(\System\Libraries\View $view){
        if ($view->getType() == \System\Libraries\View::VIEW){
            \System\Response::getInstance()->getController()->setView(
                $view->getView(),
                $view->getParams()
            );
        }
        if ($view->getType() == \System\Libraries\View::JSON) {
            echo json_encode(["status" => $view->getStatus(), "message" => $view->getMessage(), "response" => $view->getResponse()]);
        }
    }
}