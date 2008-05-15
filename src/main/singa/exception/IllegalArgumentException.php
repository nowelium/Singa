<?php

class SingaIllegalArgumentException extends SingaRuntimeException {
    
    public function __construct($message, $code = 504){
        parent::__construct($message, $code);
    }
    
}

?>