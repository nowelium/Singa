<?php

class SingaProcessExecutiveException extends SingaSystemException {
    
    public function __construct($message, $code = 902){
        parent::__construct($message, $code);
    }
    
}

?>