<?php
namespace Controller;

use System\Core\Controller;

class Error extends Controller {

    public function __construct(){
        parent::__construct();
    }

    /**
     * Error 404
     */
    public function NotFound(){
        $this->view("Error/NotFound");
    }

}