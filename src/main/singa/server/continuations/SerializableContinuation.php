<?php

/**
 * Continuation $_object: between start to shutdown
 * @author nowel
 */
class SingaSerializableContinuationImpl extends SingaDefaultContinuationImpl
    implements Serializable {
    
    public function __construct(SingaContinuation $cc = null){
        if($cc === null){
            parent::__construct($this);
        } else {
            parent::__construct($cc);
        }
    }
    
    public function serialize(){
        $serial = array();
        foreach($this->_cc as $property => $value){
            $serial[$property] = $value;
        }
        return serialize($serial);
    }
    
    public function unserialize($serialized){
        $unserialize = unserialize($serialized);
        foreach($unserialize as $property => $value){
            $this->_cc->$property = $value;
        }
    }
    
}

?>