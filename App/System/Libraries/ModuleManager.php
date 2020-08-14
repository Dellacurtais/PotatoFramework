<?php
namespace System\Libraries;

class ModuleManager {

    protected static $allModules;

    /**
     * Configurar rotas de modulos
     */
    public function setup(){
        $GetSettings = json_decode(file_get_contents(BASE_PATH."Modules/Settings.json"));
        $RoutesFile = getConfig("files_route");
        foreach ($GetSettings as $modules){
            if ($modules->active){
                if (file_exists(BASE_PATH."Modules/{$modules->key}/Settings.php")) {
                    require_once BASE_PATH."Modules/{$modules->key}/Settings.php";
                }
                if (file_exists(BASE_PATH."Modules/{$modules->key}/Routes.php")) {
                    $RoutesFile[] = BASE_PATH . "Modules/{$modules->key}/Routes.php";
                }
            }
        }
        setConfig("files_route", $RoutesFile);
        self::$allModules = $GetSettings;
    }

    public static function getModules(){
        return self::$allModules;
    }

}