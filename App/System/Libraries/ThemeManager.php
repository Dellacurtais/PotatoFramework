<?php

namespace System\Libraries;

class ThemeManager {

    public static $isBlocked = false;

    public static function setTemplateDir($dir){
        Smarty::getInstance()->setTemplateDir($dir);
    }

    public static function setVar($name, $value){
        Smarty::getInstance()->assign($name, $value);
    }

    public static function setView($file, $data, $return = false){
        if (self::$isBlocked){
            return null;
        }
        return Smarty::getInstance()->view($file.".tpl", $data, $return);
    }

    public static function setTitle($title = null){
        Smarty::getInstance()->assign("meta_title", $title);
    }

    public static function setDescription($description = null){
        Smarty::getInstance()->assign("meta_description", $description);
    }

    public static function setKeywords($keys = null){
        Smarty::getInstance()->assign("meta_keys", $keys);
    }

    public static function setFavicon($icon = null){
        Smarty::getInstance()->assign("meta_icon", $icon);
    }

    public static function setViewPhp($file, $data = []){
        getViewPhp($file, $data);
    }
}