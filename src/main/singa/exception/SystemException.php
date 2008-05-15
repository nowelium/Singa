<?php

class SingaSystemException extends Exception {
    
    public function __construct($message, $code = 901){
        parent::__construct($message, $code);
    }
    
}

?>