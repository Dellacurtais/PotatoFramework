<?php

if (!function_exists('setFlashError')) {
    /**
     * Setar uma mensagem de error
     * @param $msg
     */
    function setFlashError($msg){
        \System\Libraries\Session::getInstance()->setFlash("error", $msg);
    }
}

if (!function_exists('getFlashError')) {
    /**
     * Exibir, se houver, uma mensagem de error
     * @return null|string
     */
    function getFlashError(){
        $Error = \System\Libraries\Session::getInstance()->getFlash("error");
        if ($Error) {
            return "<div class='alert alert-danger'><i class='fa fa-times-circle'></i> {$Error}</div>";
        }
        return null;
    }
}

if (!function_exists('setFlashSuccess')) {
    /**
     * Setar mensagem de successo
     * @param $msg
     */
    function setFlashSuccess($msg){
        \System\Libraries\Session::getInstance()->setFlash("success", $msg);
    }
}

if (!function_exists('getFlashSuccess')) {
    /**
     * Exibir, se houver, uma mensagem de sucesso
     * @return null|string
     */
    function getFlashSuccess(){
        $Success = \System\Libraries\Session::getInstance()->getFlash("success");
        if ($Success) {
            return "<div class='alert alert-success'><i class='fa fa-check'></i> {$Success}</div>";
        }
        return null;
    }
}

if (!function_exists('setFlashWarning')) {
    /**
     * Setar mensagem de Alerta
     * @param $msg
     */
    function setFlashWarning($msg){
        \System\Libraries\Session::getInstance()->setFlash("warning", $msg);
    }
}

if (!function_exists('getFlashWarning')) {
    /**
     * Exibir, se houver, uma mensagem de Alerta
     * @return null|string
     */
    function getFlashWarning(){
        $Warning = \System\Libraries\Session::getInstance()->getFlash("warning");
        if ($Warning) {
            return "<div class='alert alert-warning'><i class='fa fa-warning'></i> {$Warning}</div>";
        }
        return null;
    }
}