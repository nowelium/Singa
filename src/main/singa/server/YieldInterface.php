<?php

/**
 * @author nowel
 */
interface SingaYield extends Iterator {
    
    /**
     * 
     */
    public function prev();
    
    /**
     * 
     */
    public function addObject(SingaYieldable $object);
    
    /**
     * 
     */
    public function getObject();
}

?>