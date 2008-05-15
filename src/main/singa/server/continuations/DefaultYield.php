<?php

/**
 * @author nowel
 */
class SingaDefaultYieldImpl implements SingaYield {
    
    /** */
    protected $object = null;
    
    /** */
    protected $stack = array();
    
    /**
     * 
     */
    public function __construct(SingaYieldable $object = null){
        if($object !== null){
            $this->object = $object;
        }
    }
    
    /**
     * 
     */
    public function __destruct(){
        unset($this->object);
    }
    
    /**
     * 
     */
    public function rewind(){
        $this->stack = array();
        $this->stack[] = clone $this->object;
    }
    
    /**
     * 
     */
    public function current(){
        return $this->object;
    }
    
    /**
     * 
     */
    public function valid(){
        return $this->object->yield();
    }
    
    /**
     * 
     */
    public function key(){
        return count($this->stack);
    }
    
    /**
     * 
     */
    public function addObject(SingaYieldable $object){
        $this->object = $object;
    }
    
    /**
     * 
     */
    public function getObject(){
        return $this->object;
    }
    
    /**
     * 
     */
    public function next(){
        if($this->object->yield()){
            $this->stack[] = clone $this->object;
            return $this->object;
        }
        return false;
    }
    
    /**
     * 
     */
    public function prev(){
        if($this->object->yield()){
            $this->object = array_pop($this->stack);
            return $this->object;
        }
        return false;
    }
}
?>