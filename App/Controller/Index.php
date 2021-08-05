<?php
namespace Controller;

use System\Core\Controller;
use System\Request;
use System\Response;

class Index extends Controller {

    public function __construct(){
        parent::__construct();
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return \System\Libraries\ViewHtml
     *
     * When the method has $request and $response in the parameters, both will automatically assume class System\Response and System\Request
     */
    public function Index(Request $request, Response $response){

        return $response->html()
            ->setView("Layout/Content")
            ->setParams([ "layout" => "welcome.tpl" ]);
    }

    /**
     * Ex Dynamics urls
     * We can retrieve the dynamic value with same name paramaters
     * Ex:  @route find/{id} : {id} -> $id
     * When the method has $request and $response in the parameters, both will automatically assume class System\Response and System\Request
     *
     * @param mixed $id dynamic value in url {id}
     */
    public function FindExample($id){

    }

}