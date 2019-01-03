<?php
namespace System\Core;

use System\Request;
use System\Response;

class Routes {

    protected static $Routes = [];
    protected static $DynamicRoutes = [];

    public static function all($route, $configs){
        self::setRoute(Response::ALL, $route, $configs);
    }

    public static function get($route, $configs){
        self::setRoute(Response::GET, $route, $configs);
    }

    public static function post($route, $configs){
        self::setRoute(Response::POST, $route, $configs);
    }

    public static function put($route, $configs){
        self::setRoute(Response::PUT, $route, $configs);
    }

    public static function delete($route, $configs){
        self::setRoute(Response::DELETE, $route, $configs);
    }

    public static function patch($route, $configs){
        self::setRoute(Response::PATCH, $route, $configs);
    }

    public static function options($route, $configs){
        self::setRoute(Response::OPTIONS, $route, $configs);
    }

    public static function head($route, $configs){
        self::setRoute(Response::HEAD, $route, $configs);
    }

    public static function other($type, $route, $configs){
        self::setRoute($type, $route, $configs);
    }

    public static function getRoute($route, $method){
        if (isset(self::$Routes[$route][$method])){
            return self::$Routes[$route][$method];
        }
        if (isset(self::$Routes[$route][Response::ALL])){
            return self::$Routes[$route][Response::ALL];
        }
        return null;
    }

    public static function verifyRoute($route, $method){
        if (isset(self::$Routes[$route][$method])){
            return true;
        }
        if (isset(self::$Routes[$route][Response::ALL])){
            return true;
        }
        foreach (self::$DynamicRoutes as $route => $nRoute){
            foreach ($nRoute as $type => $args){
                $key = str_replace([':any', ':num'], ['[^/]+', '[0-9]+'], $route);
                if (preg_match('#^'.$key.'$#', $route, $matches)){
                    self::$Routes[$matches[0]][$type] = $args;
                    return true;
                    break;
                }
            }
        }
        return false;
    }

    public static function validateRoute($Route){
        if (isset($Route['Headers']) && is_array($Route['Headers'])){
            foreach ($Route['Headers'] as $header){
                Response::getInstance()->setHeader($header);
            }
        }
        if (isset($Route['RequireHeader']) && is_array($Route['RequireHeader'])){
            foreach ($Route['RequireHeader'] as $key=>$header){
                if (Request::getInstance()->getHeader($key) !== $header){
                    HooksRoutes::getInstance()->onCallError("No have \"{$key}\" in request header");
                }
            }
        }
    }

    protected static function setRoute($method, $route, $configs){
        if (strpos(":any",$route) !== false || strpos(":num",$route) !== false){
            self::$DynamicRoutes[$route][$method] = $configs;
        }
        self::$Routes[$route][$method] = $configs;
    }
}