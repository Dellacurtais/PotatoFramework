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
        if (isset($lasterror['type']))
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

if (!function_exists("getViewPhp")){
    /**
     * Get HTML template PHP
     * @param $_file
     * @param array $data
     */
    function getViewPhp($_file, $data = array()){
        extract($data);
        include BASE_PATH . "Views/" . $_file;
    }
}

if (!function_exists("getClientIpServer")){
    /**
     * @return mixed|null
     */
    function getClientIpServer() {
        $ipaddress = null;
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';

        return $ipaddress;
    }
}

if (!function_exists("verifySo")){
    /**
     * @param null $u_agent
     * @param null $ip
     * @return array
     */
    function verifySo($u_agent = null, $ip = null){
        if ($ip == null){
            $ip = getClientIpServer();
        }
        if ($u_agent == null){
            $u_agent = $_SERVER['HTTP_USER_AGENT'];
        }

        $bname = 'Unknown';
        $platform = 'Unknown';
        $version = "";

        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'Linux';
        }elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'Mac';
        }elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'Windows';
        }


        if(preg_match('/Edge/i',$u_agent)) {
            $bname = 'Edge';
            $ub = "Edge";
        }elseif(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        }elseif(preg_match('/Trident/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) {
            $bname = 'Internet Explorer';
            $ub = "Trident";
        }elseif(preg_match('/Firefox/i',$u_agent)) {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        }elseif(preg_match('/Chrome/i',$u_agent)) {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        }elseif(preg_match('/AppleWebKit/i',$u_agent)) {
            $bname = 'AppleWebKit';
            $ub = "Opera";
        }elseif(preg_match('/Safari/i',$u_agent)) {
            $bname = 'Apple Safari';
            $ub = "Safari";
        }elseif(preg_match('/Netscape/i',$u_agent)) {
            $bname = 'Netscape';
            $ub = "Netscape";
        }

        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
        }

        $i = count($matches['browser']);
        if ($i != 1) {
            if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                $version= $matches['version'][0];
            }else{
                $version= $matches['version'][1];
            }
        }else{
            $version= $matches['version'][0];
        }

        if ($ub == "Trident"){
            preg_match('#rv:([0-9.|a-zA-Z.]*)#',$u_agent, $versions);
            $version = $versions[1];
        }

        // check if we have a number
        if ($version==null || $version=="") {$version="?";}

        $Browser = array(
            'ip' => $ip,
            'userAgent' => $u_agent,
            'name'      => $bname,
            'version'   => $version,
            'platform'  => $platform,
            'pattern'    => $pattern
        );
        return $Browser;
    }
}
