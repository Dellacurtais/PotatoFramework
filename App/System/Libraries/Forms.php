<?php
namespace System\Libraries;

use System\Request;

class Forms {

    protected static $instance;

    public static function getInstance(){
        if (self::$instance ==  null){
            self::$instance = new Forms();
        }
        return self::$instance;
    }

    protected $inputs = [];
    protected $errors = [];
    protected $getFields = [];

    public function __construct(){
        self::$instance = $this;
    }

    /**
     * @param $key
     * @param $functionRule mixed array, function
     * @param $args mixed
     */
    public function setRules($key, $require = false, $functionRule = null, $args = null, $msgError = null){
        $this->inputs[$key] = [ $require, $functionRule, $args, $msgError ];
    }

    /**
     * @param $formName string name form
     * @param $token string token form
     * @return bool
     */
    private function validToken($formName, $token){
        $CodeForm = Session::getInstance()->getFlash($formName);
        if ($CodeForm === $token){
            return true;
        }
        return false;
    }

    /**
     * Generate random code to return on ajax response
     * @param $NameForm string name of form
     * @return string token form
     */
    public function initJson($NameForm){
        $CodeForm = randomCode(8);
        Session::getInstance()->setFlash($NameForm, $CodeForm);
        return $CodeForm;
    }

    /**
     * @param $attr array Atributos do Form
     * @param $NameForm string key form name
     * @return string
     */
    public function init($attr, $NameForm){
        $attrs = "";
        foreach ($attr as $key => $item){
            $attrs .= "{$key}=\"{$item}\" ";
        }

        $CodeForm = randomCode(8);
        Session::getInstance()->setFlash($NameForm, $CodeForm);
        return "<form {$attrs}><input type='hidden' name='{$NameForm}' value='$CodeForm'>";
    }

    public function end(){
        return "</form>";
    }

    /**
     * @param string|null $NameForm Nome do Fomulário se houver
     * @param string $type
     * @param int $xss
     * @throws \Exception
     */
    public function validate($NameForm, $type = "POST", $xss = 0){
        $Method = null;
        switch ($type){
            case Request::GET:
                $Method = "get";
                break;
            case Request::REQUEST:
                $Method = "request";
                break;
            case Request::JSON:
                $Method = "json";
                break;
            case Request::EXTRA:
                $Method = "extra";
                break;
            case Request::POST:
            default:
                $Method = "post";
                break;
        }

        if (!is_null($NameForm)) {
            $TokenForm = Request::getInstance()->$Method($NameForm);
            if (!$this->validToken($NameForm, $TokenForm)) {
                $this->errors[$NameForm] = Lang::get("form_invalid_token");
                return;
            }
        }

        foreach ($this->inputs as $input => $args){
            $Value = Request::getInstance()->$Method($input, $xss);
            $this->getFields[$input] = $Value;
            try {
                $isRequire = $args[0];
                if ($isRequire && (empty($Value) || is_null($Value))){
                    if (!is_null($args[3])){
                        $msgError = $args[3];
                    }else{
                        $msgError = Lang::get("form_require",":attr:", Lang::get("input_{$input}"));
                    }
                    $this->errors[$input] = $msgError;
                }else{
                    if (!$isRequire && (empty($Value) || is_null($Value))){
                        continue;
                    }

                    if (is_array($args[1])){
                        $Class = $args[1][0];
                        $ValidMethod = $args[1][1];
                        $isValid = $Class->$ValidMethod($Value, $args[2]);
                        if (!$isValid){
                            if (!is_null($args[3])){
                                $msgError = $args[3];
                            }else{
                                $msgError = Lang::get("input_error_{$input}");
                            }
                            $this->errors[$input] = $msgError;
                        }
                    }else{
                        $FunctionTry = $args[1];
                        $isValid = $FunctionTry($Value, $args[2]);
                        if (!$isValid){
                            if (!is_null($args[3])){
                                $msgError = $args[3];
                            }else{
                                $msgError = Lang::get("input_error_{$input}");
                            }
                            $this->errors[$input] = $msgError;
                        }
                    }
                }
            }catch (\Exception $e){
                throw new \Exception($e->getMessage());
            }
        }
    }

    /**
     * Get Validate Fields
     * @param $key string
     * @return array|string
     */
    public function getFields($key = null){
        if (!is_null($key)) {
            if (!isset($this->getFields[$key]) || empty($this->getFields[$key]))
                return null;
            return $this->getFields[$key];
        }
        return $this->getFields;
    }

    /**
     * Verifica se possuí erros no formulário
     * @return bool
     */
    public function hasErrors(){
        if (count($this->errors) > 0){
            return true;
        }
        return false;
    }

    /**
     * Obter todos os erros
     * @return array Lista de erros
     */
    public function getErrors(){
        return $this->errors;
    }
}
