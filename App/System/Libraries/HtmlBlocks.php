<?php
namespace System\Libraries;

class HtmlBlocks {

    protected static $instance;
    public $Block;

    /**
     * HtmlBlocks constructor.
     */
    public function __construct(){
        if (is_null(self::$instance)){
            self::$instance = $this;
        }
    }

    /**
     * Obter Instancia
     * @return HtmlBlocks
     */
    public static function getInstance(){
        if (is_null(self::$instance)){
            self::$instance = new static();
        }
        return self::$instance;
    }

    /**
     * Iniciar captura do flush
     */
    public function initBlock(){
        ob_start();
    }

    /**
     * Finalizar captura do flush
     * @param string $Location Nome do bloco
     */
    public function endBlock($Location = "Default"){
        $this->Block[$Location][] = ob_get_contents();
        ob_end_clean();
    }

    /**
     * Obter bloco html
     * @param $Location String Nome do bloco
     * @param null $id int Indice do bloco
     * @return mixed
     */
    public function getBlocks($Location,$id = null){
        if ($id !== null)
            return $this->Block[$Location][$id];

        return $this->Block[$Location];
    }

    /**
     * Limpar blocos especificos
     * @param $Location String Nome do Bloco
     */
    public function clearBlocks($Location){
        unset($this->Block[$Location]);
    }

    /**
     * Limpar todos os blocos
     */
    public function clearAllBlocks(){
        $this->Block = array();
    }
}