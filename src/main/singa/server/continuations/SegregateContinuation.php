<?php

/**
 * @author nowel
 */
abstract class SingaSegregateContinuation extends SingaDefaultContinuationImpl {
    
    private $isRunning = false;
    private $isChildren = false;
    
    public function __construct(){
        parent::__construct($this);
        register_shutdown_function(array($this, 'shutdown'));
    }
    
    public function start(){
        if(!$this->runnize()){
            throw new SingaProcessExecutiveException("do not staron");
        }
        
        $this->isRunning = true;
        while($this->isRunning){
            $this->doExecute();
        }
        return true;
    }
    
    protected abstract function doExecute();
    
    public function shutdown(){
        $this->isRunning = false;
        return pcntl_waitpid($this->id, $this->status, WUNTRACED);
    }
    
    public function suspend($timeout){
        if ($timeout < 0){
            throw new SingaIllegalArgumentException();
        }
        try {
            if (!$this->_cc->_resumed && 0 < $timeout){
                pcntl_waitpid(-1, $this->status, WUNTRACED);
            }
        } catch (Exception $e){
            throw new SingaRuntimeException($e);
        }
        return parent::__suspend($timeout);
    }
    
    private function fork(){
        $pid = pcntl_fork();

        if ($pid == -1) {
            // error
            //throw new SingaProcessExecutiveException("Could not fork");
            return false;
        } else if ($pid) {
            // parent
            //throw new SingaProcessExecutiveException("Killing parent");
            die;
        } else  {
            // children
            $this->isChildren = true;
            $this->id = posix_getpid();
        }
        return true;
    }
    
    private function runnize() {
        if ($this->isRunning()) {
            // is already running. Exiting
            return false;
        }

        if (!$this->fork()) {
            // Coudn't fork. Exiting.
            return false;
        }

        if (!posix_setsid()) {
            // $this->_logMessage('Could not make the current process a session leader', DLOG_ERROR);
            return false;
        }

        declare(ticks = 1);

        pcntl_signal(SIGCHLD, array($this, 'sigHandler'));
        pcntl_signal(SIGTERM, array($this, 'sigHandler'));
        pcntl_signal(SIGHUP, array($this, 'sigHandler'));

        return true;
    }

    private function isRunning(){
        return $this->isRunning;
    }

    private function sigHandler($sigNo) {
        switch ($sigNo) {
        case SIGTERM:
            // shutdown signal
            $this->shutdown();
            die;
        break;
        case SIGCHLD:
            // halt signal
            while (pcntl_waitpid(-1, $this->status, WNOHANG) > 0);
        break;
        case SIGHUP:
            // relase
            $this->resume();
        break;
        }
    }

}

?>