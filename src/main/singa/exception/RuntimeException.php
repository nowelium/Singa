<?php

class SingaRuntimeException extends RuntimeException {
    
    public function __construct($message, $code = 304){
        parent::__construct($message, $code);
    }
    
}

?>