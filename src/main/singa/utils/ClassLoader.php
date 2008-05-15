<?php

/**
 * @author nowel
 */
final class SingaClassLoader implements SingaLoader {
    
    private static $instance = null;
    private $classes = array();
    
    private function __construct(){
    }
    
    public function initialize(){
        self::addLoader($this);
    }
    
    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new self();
            self::$instance->initialize();
        }
        return self::$instance;
    }
    
    public static function __load($callClass){
        $instance = self::getInstance();
        $classes = $instance->classes;
        
        if(!isset($classes[$callClass])){
            return false;
        }
        $path = $classes[$callClass];
        if(!file_exists($path)){
            return false;
        }
        return require_once $path;
    }
    
    public static function addLoader(SingaLoader $loader){
        return spl_autoload_register(array($loader, '__load'));
    }
    
    public static function import($file){
        $instance = self::getInstance();
        if(!is_array($file) && is_string($file)){
            $className = basename($file, '.php');
            $instance->classes[$className] = $file;
        } else {
            foreach($file as $f){
                $instance->import($f);
            }
        }
    }
    
}

?>