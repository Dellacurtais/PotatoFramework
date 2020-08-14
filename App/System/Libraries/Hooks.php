<?php
namespace System\Libraries;

class Hooks {

    private static $onCallBefore = [];
    private static $onCallAfter = [];

    /**
     * Adicionar evento para executar antes das chamadas de rotas
     * @param $class
     * @param $method
     */
    public static function registerCallBefore($class, $method){
        self::$onCallBefore[] = array($class, $method);
    }

    /**
     * Adicionar eventos
     * @param $events
     */
    public static function registerCallsBefore($events){
        foreach ($events as $class => $method) {
            self::$onCallBefore[] = array($class, $method);
        }
    }

    /**
     * Adicionar evento para executar apos a chamada de rotas
     * @param $class
     * @param $method
     */
    public static function registerCallAfter($class, $method){
        self::$onCallAfter[] = array($class, $method);
    }

    /**
     * Adicionar Eventos
     * @param $events
     */
    public static function registerCallsAfter($events){
        foreach ($events as $class => $method) {
            self::$onCallAfter[] = array($class, $method);
        }

    }

    /**
     * Executar eventos
     */
    public static function executeCallBefore(){
        foreach (self::$onCallBefore as $item){
            execute_class($item[0], $item[1]);
        }
    }

    /**
     * Executar eventos
     */
    public static function executeCallAfter(){
        foreach (self::$onCallAfter as $item){
            execute_class($item[0], $item[1]);
        }
    }
}