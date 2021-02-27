<?php
namespace System\Libraries;

class EmailSend {
    protected static $_instance = null;

    protected $config = array();
    protected $BodyEmail = "";
    protected $email = array();
    protected $copyEmail = array();
    protected $from = array();
    protected $subject = "";

    public function __construct(){
        if (is_null(self::$_instance)) {
            self::$_instance = $this;
        }
        $this->initConfig();
    }

    public static function getInstance(){
        if (is_null(self::$_instance)) {
            self::$_instance = new static();
        }
        return self::$_instance;
    }

    public function initConfig(){
        $Config = getConfig("Email");
        $this->config = Array(
            'protocol' => 'smtp',
            'smtp_host' => $Config["smtp_host"],
            'smtp_port' => $Config["smtp_port"],
            'smtp_user' => $Config["smtp_user"],
            'smtp_pass' => $Config["smtp_pass"],
            'mailtype'  => 'html',
            'charset'   => 'utf-8'
        );
        $this->from['email'] = $Config["smtp_user"];
        $this->from['nome'] = $Config["smtp_name"];
    }

    public function setBody($file, $args = [], $isFile = false){
        if ($isFile) {
            $GetTemplate = file_get_contents(BASE_PATH . "Views/Emails/{$file}.tpl");
            if (is_array($args) && count($args) > 0) {
                $GetArgs = array_keys($args);
                foreach ($GetArgs as $k => $arg) {
                    $GetArgs[$k] = "{" . $arg . "}";
                }
                $GetVals = array_values($args);
                $GetTemplate = str_replace($GetArgs, $GetVals, $GetTemplate);
            }
            $this->BodyEmail = $GetTemplate;
        }else{
            $this->BodyEmail = $file;
            if (is_array($args) && count($args) > 0) {
                $GetArgs = array_keys($args);
                foreach ($GetArgs as $k => $arg) {
                    $GetArgs[$k] = "{" . $arg . "}";
                }
                $GetVals = array_values($args);
                $this->BodyEmail = str_replace($GetArgs, $GetVals, $this->BodyEmail);
            }
        }
    }

    public function setFrom($email,$nome){
        $this->from['email'] = $email;
        $this->from['nome'] = $nome;
    }

    public function setSubject($assunto){
        $this->subject = $assunto;
    }

    public function setEmail($email){
        if (is_array($email)){
            foreach ($email as $value){
                $this->email[] = $value;
            }
        }else{
            $this->email[] = $email;
        }
    }

    public function setCopyEmail($email){
        if (is_array($email)){
            foreach ($email as $value){
                $this->copyEmail[] = $value;
            }
        }else{
            $this->copyEmail[] = $email;
        }
    }

    public function sendMail(){
        $Email = new Email($this->config);
        $Email->from($this->from['email'], $this->from['nome']);
        foreach ($this->email as $email) {
            $Email->to($email);
        }
        foreach ($this->copyEmail as $d => $mail) {
            $Email->cc($mail);
        }
        $Email->subject($this->subject);
        $Email->message($this->BodyEmail);
        return $Email->send();
    }

}