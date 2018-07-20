<?php
namespace System\Libraries;

class Forms {
    protected static $instance;

    public static function getInstance(){
        if (self::$instance ==  null){
            self::$instance = new Forms();
        }
        return self::$instance;
    }


}