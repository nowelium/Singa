<?php

class FooObject implements SingaYieldable {

    private $count = 0;
    
    public function process(){
        return $this->count++;
    }

    public function yield(){
        return $this->count < 20;
    }
}

?>
