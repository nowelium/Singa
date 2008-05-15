<?php

class HogeObject implements SingaContinuable {

    private $counter = 0;
    
    public function execute(){
        debug_zval_dump($this->counter);
        $this->counter++;
    }

}

?>
