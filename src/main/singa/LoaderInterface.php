<?php

/**
 * @author nowel
 */
interface SingaLoader {
    
    public static function getInstance();
    
    public static function __load($class);
    
}

?>