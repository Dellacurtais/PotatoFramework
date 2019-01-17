<?php
namespace System\Core;

use System\FastApp;
use System\Libraries\HtmlBlocks;
use System\Libraries\Lang as Lang;
use System\Libraries\Session as Session;
use System\Libraries\Smarty as Smarty;
use System\Response;

class Controller {

    private $hasEngine = null;
    private $smarty = null;
    private $lang = null;

    /**
     * Construtor do controlador
     * Controller constructor.
     */
    public function __construct(){
        $this->hasEngine = FastApp::getInstance()->getConfig("template");
        if ($this->hasEngine == TEMPLATE_ENGINE_SMARTY) {
            $this->smarty = Smarty::getInstance();
        }

        $this->lang = Lang::getInstance();
    }

    /**
     * Obter a instancia do Framework
     * @return null|FastApp Get app instance
     */
    public function getApp(){
        return FastApp::getInstance();
    }

    /**
     * Obter Sessão
     * @return null|Session get session instance system Librarie
     */
    public function getSession(){
        return Session::getInstance();
    }

    /**
     * Set Content-Type of header
     * @param $type string Type of Response
     */
    public function setResponseType($type){
        Response::getInstance()->setHeaderType($type);
    }

    /**
     * Incluir um helper
     * @param $file string Name of Helper File
     * @throws \Exception
     */
    public function loadHelper($file){
        FastApp::getInstance()->loadHelper($file);
    }

    /**
     * Load view Smarty
     * @param $file string nome do view
     * @param array $data parametros pro view
     * @param bool $return bool true para retornar o HTML
     * @return null|string
     */
    public function setView($file, $data = array(), $return = false){
        if ($this->hasEngine == TEMPLATE_ENGINE_SMARTY) {
            return $this->smarty->view($file.".tpl", $data, $return);
        }else{
            return $this->setViewWithoutTemplate($file,$data, $return);
        }
    }

    /**
     * View default sem template
     * @param $_file_
     * @param array $data
     * @param bool $return
     * @return null|string
     */
    public function setViewWithoutTemplate($_file_, $data = array(), $return = false){
        if ($return){
            extract($data);
            HtmlBlocks::getInstance()->initBlock();
                include BASE_PATH . "Views/" . $_file_ . ".php";
            HtmlBlocks::getInstance()->endBlock("GetTemplate");
            return HtmlBlocks::getInstance()->getBlocks("GetTemplate", 0);
        }else{
            extract($data);
            include BASE_PATH . "Views/" . $_file_ . ".php";
            return null;
        }
    }
}