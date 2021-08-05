<?php
namespace System\Libraries;

use System\Response;

class View {
    const JSON = 'json';
    const VIEW = 'view';

    protected $file;
    protected $params;
    protected $message;
    protected $status;
    protected $type = "view";

    public static function getHtml(){
        return new ViewHtml();
    }

    public static function getJson(){
        return new ViewJson();
    }

    public function __construct($type){
        $this->type = $type;
    }

    public function getType(){
        return $this->type;
    }

}

class ViewHtml extends View {

    public function __construct(){
        parent::__construct(View::VIEW);
    }

    /**
     * @param string $file
     * @return $this
     */
    public function setView(string $file){
        $this->file = $file;
        return $this;
    }

    public function getView(){
        return $this->file;
    }

    /**
     * @param array $params
     * @return $this
     */
    public function setParams(array $params){
        $this->params = $params;
        return $this;
    }

    public function getParams(){
        return $this->params;
    }
}

class ViewJson extends View {

    public function __construct(){
        parent::__construct(View::JSON);
    }

    public function setStatus(string $status){
        $this->status = $status;
        return $this;
    }

    public function getStatus(){
        return $this->status;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function setMessage(string $message){
        $this->message = $message;
        return $this;
    }

    public function getMessage(){
        return $this->message;
    }

    /**
     * @param array|string $params
     * @return $this
     */
    public function setResponse($params){
        $this->params = $params;
        return $this;
    }

    public function getResponse(){
        return $this->params;
    }
}
