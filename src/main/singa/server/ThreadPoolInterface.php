<?php

interface SingaThreadPool {
    
    public function setHook(SingaHookThread $hook);
    public function getHook();
    
    public function startService();
    public function sopService();
    
    public function getThreads();
    public function dispatch(Runnable $job);
}

?>