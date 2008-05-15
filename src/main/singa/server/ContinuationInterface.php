<?php

interface SingaContinuation {
    
    public function isNew();
    
    public function start();
    
    public function shutdown();
    
    public function resume();
    
    public function suspend($msecond);
    
    public function reset();
    
    public function addObject(SingaContinuable $object);
    
    public function getObject();
}

?>