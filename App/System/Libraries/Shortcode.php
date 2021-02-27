<?php
namespace System\Libraries;

use Thunder\Shortcode\HandlerContainer\HandlerContainer;
use Thunder\Shortcode\Parser\RegularParser;
use Thunder\Shortcode\Processor\Processor;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class Shortcode {

    private static $instance = null;
    private $handlers = null;
    private $processor  = null;

    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new Shortcode();
        }
        return self::$instance;
    }

    public function __construct(){
        try{
            $this->handlers = new HandlerContainer();
        }catch (\Exception $e){
            exit();
        }
    }

    /**
     * @param $name
     * @param $function
     */
    public function addHandlers($name, $function){
        $this->handlers->add($name, $function);
    }

    /**
     * @return String|null
     */
    public function getProcessor($text){
        if ($this->processor == null){
            $this->processor = new Processor(new RegularParser(), $this->handlers);
        }
       return $this->processor->process($text);
    }
}
