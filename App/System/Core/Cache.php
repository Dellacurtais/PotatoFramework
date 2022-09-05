<?php
namespace System\Core;

use Attribute;
use System\FastApp;

#[Attribute]
class Cache {

    public $isInvalid = true;

    public function __construct(public bool $useUrl = true, public ?string $key = null, public $time = 3600) {}

    public function execute(){
        if ($this->useUrl){
            $cacheFile = BASE_PATH_CACHE . 'Response/' . base64_encode(FastApp::getInstance()->getUri()) .".cache";
        }else{
            $cacheFile = BASE_PATH_CACHE . 'Response/' . base64_encode($this->key) .".cache";
        }

        if (file_exists($cacheFile) && (time() - $this->time) < filemtime($cacheFile)) {
            $this->isInvalid = false;
            readfile($cacheFile);
        }
    }

    public function saveCache($data){
        if ($this->useUrl){
            $cacheFile = BASE_PATH_CACHE . 'Response/' . base64_encode(FastApp::getInstance()->getUri()).".cache";
        }else{
            $cacheFile = BASE_PATH_CACHE . 'Response/' . base64_encode($this->key) .".cache";
        }

        file_put_contents($cacheFile, $data);
        echo $data;
    }

    public static function clearCache(string $key = null){
        $cacheFile = BASE_PATH_CACHE . 'Response/' . base64_encode($key) .".cache";
        if (is_file($cacheFile)){
            @unlink($cacheFile);
        }
    }

}