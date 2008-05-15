<?php

/**
 * @author nowel
 */
class SingaServerImpl implements SingaServer {
    
    private $hookThead;
    private $threadPool;
    private $configure;
    private $handlers;
    private $connector;
    
    public function __construct(SingaConfigure $configure){
        $this->configure = $configure;
        $this->hookThread = new SingaHookThreadImpl($this);
        $this->connector = new SingaConnectorImpl($this);
        $this->handlers = new ArrayObject();
    }
    
    public function setThreadPool(SingaThreadPool $threadPool){
        $this->threadPool = $threadPool;
    }
    
    public function getThreadPool(){
        return $this->threadPool;
    }
    
    public function doStart(){
        $this->hookThread->addThread($this);
        if($this->threadPool === null){
            $boundThreadPool = new SingathreadPool();
            $boundThreadPool->setHook($this->hookThread);
            $this->setThreadPool($boundThreadPool);
        }
        
        $this->threadPool->startService();
    }
    
    public function doStop(){
        $this->threadPool->stopService();
    }
    
    public function handle(SingaHttpConnection $connection){
        $iter = $this->handlers->getIterator();
        while($iter->valid()){
            $handler = $iter->next();
            $handler->setServer($this);
            $handler->handle($connection);
        }
    }
    
    public function addHandler(SingaHandler $handler){
        $this->handlers[] = $handler;
    }
    
    public function setHandlers(array $handlers){
        foreach($handlers as $h){
            $this->handlers[] = $h;
        }
    }
    
    public function getHandlers(){
        return $this->handlers;
    }
    
    public function removeHandler(SingaHandler $handler){
        foreach($this->handlers as &$h){
            if($handler === $h){
                unset($h);
            }
        }
    }
    
}
?>