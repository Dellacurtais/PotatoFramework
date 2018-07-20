<?php
if (!function_exists('redirect')){
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
    function _uri_string($uri){
        global $Config;
        if ($Config['enable_query_strings'] === FALSE) {
            is_array($uri) && $uri = implode('/', $uri);
            return ltrim($uri, '/');
        } elseif (is_array($uri)) {
            return http_build_query($uri);
        }
        return $uri;
    }
}

if (!function_exists("base_url")) {
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

if (!function_exists("slash_item")) {
    function slash_item($item){
        global $Config;
        if (!isset($Config[$item])){
            return NULL;
        }elseif (trim($Config[$item]) === ''){
            return '';
        }
        return rtrim($Config[$item], '/').'/';
    }
}
