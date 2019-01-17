<?php
namespace Controller;

use System\Core\Controller;

class Index extends Controller {

    public function __construct(){
        parent::__construct();
    }

    public function Index(){
        if (getConfig("template") === TEMPLATE_WITHOUT_ENGINE) {
            $this->setView("Layout/Content", [
                "layout" => "welcome.php"
            ]);
        }else{
            $this->setView("Layout/Content", [
                "layout" => "welcome.tpl"
            ]);
        }
    }

}