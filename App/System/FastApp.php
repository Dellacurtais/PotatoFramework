<?php
namespace System;

use System\Core\DefaultErrors;
use System\Core\HooksRoutes;
use System\Core\Routes;
use System\Libraries\Lang;

class FastApp {
    protected static $instance;

    protected $Config;
    protected $Patch;
    protected $Default;

    protected $RequestURI;
    protected $Route;

    /**
     * Obter instancia do framework
     * @return FastApp
     */
    public static function getInstance(){
        if (is_null(self::$instance)){
            self::$instance = new FastApp(true);
        }
        return self::$instance;

    }

    /**
     * Setups de configurações, rotas e bibliotecas
     * FastApp constructor.
     * @param bool $onlyLoad
     */
    public function __construct($onlyLoad = false){
        self::$instance = $this;

        $this->loadHelper("System");
        $this->Config = getConfig();

        if ($onlyLoad) return;

        Lang::getInstance()->load("System");
        loadFilesRoute();

        //Load Helpers
        try {
            $HelpersLoads = getConfig('helpersLoad');
            if (is_array($HelpersLoads)) {
                foreach ($HelpersLoads as $helper) {
                    $this->loadHelper($helper);
                }
            }
        }catch (\Exception $exception){
            DefaultErrors::getInstance()->ErrorXXX($exception->getCode(), $exception);
        }

        //Set Connection
        $this->initDatabase();

        //CONTROLLER & METHODS
        $this->RequestURI = getUriPatch();
        $RequestMethod = $_SERVER['REQUEST_METHOD'];

        $this->rePatch($this->RequestURI);
        if (empty($this->Patch[0]) && !empty($this->Config['default_route'])) {
            $this->RequestURI = $this->Config['default_route'];
            $this->rePatch($this->RequestURI);
        }

        if (!Routes::verifyRoute($this->RequestURI, $RequestMethod)) {
            $nController = "\\Controller\\".$this->Patch[0];
            $nMethod = isset($this->Patch[1]) ? $this->Patch[1] : "index";

            if (!execute_class($nController, $nMethod)) {
                goto OnNotFound;
            }
        }else{
            $this->Route = Routes::getRoute($this->RequestURI, $RequestMethod);
            Routes::validateRoute($this->Route);

            execute_callbacks($this->Route, 'onCallBefore');

            if (execute_class($this->Route['Controller'], $this->Route['Method'])) {
                execute_callbacks($this->Route, 'onCallAfter');
                return;
            }

            goto OnNotFound;
        }

        OnNotFound:{
            HooksRoutes::getInstance()->onNotFound();
        }
    }

    /**
     * Explode nos paths do URL
     * @param $Folder
     */
    public function rePatch($Folder){
        $this->Patch = explode("/",$Folder);
    }

    /**
     * Obter valor de um path da url
     * @param $key int Número do indice
     * @return null|string Retorna o valor do indice ou null se não existir
     */
    public function getPatch($key){
        if (!isset($this->Patch[$key]))
            return null;

        return $this->Patch[$key];
    }

    /**
     * Obter valores de configuração
     * @param $key String indice da configuração que deseja
     * @return mixed Retorna valor de configuração do indice definido
     */
    public function getConfig($key){
        return $this->Config[$key];
    }

    /**
     * Obter a url atual
     * @return mixed
     */
    public function getUri(){
        return $this->RequestURI;
    }

    /**
     * Verifica se o valor passado é igual o da URL
     * @param $uri String URL de comparação
     * @return bool
     */
    public function isUri($uri){
        if ($this->RequestURI === $uri){
            return true;
        }
        return false;
    }

    /**
     * Incluir helpers
     * @param $file
     * @throws null
     */
    public function loadHelper($file){
        $isFind = false;

        if (file_exists(BASE_PATH."Helpers/".$file.".php")) {
            require(BASE_PATH . "Helpers/" . $file . ".php");
            $isFind = true;
        }
        if (file_exists(BASE_PATH."System/Helpers/".$file.".php")){
            require(BASE_PATH."System/Helpers/".$file.".php");
            $isFind = true;
        }
        if (!$isFind){
            throw new \Exception("File Helper {$file} not found");
        }
    }

    /**
     * Inicia as configurações de banco de dados
     */
    private function initDatabase(){
        if ($this->Config['db_driver']["isActive"] && (
            !is_null($this->Config["db_driver"]['class']) ||
            !empty($this->Config["db_driver"]['class'])
            )){
            if (class_exists($this->Config["db_driver"]['class'])){
                $DriverClass = $this->Config["db_driver"]['class'];
                /**
                 * @var $Driver \System\Database\DriverImplements
                 */
                $Driver = new $DriverClass();
                $Driver->createConnection($this->Config["db_driver"]["config"]);
            }
        }
    }

    /**
     * Destruc, executado no final de tudo
     */
    public function __destruct(){
        execute_callbacks($this->Route, 'onCallFinish');
    }

}