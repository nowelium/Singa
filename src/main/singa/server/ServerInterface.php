<?php
interface SingaServer {
	
    public function doStart();
	
    public function doStop();
	
    public function handle(SingaHttpConnection $connection);
	
    public function addHandler(SingaHandler $handler);
	
    public function getHandlers();
	
    public function removeHandler(SingaHandler $handler);
	
    public function setHandlers(array $handlers);
	
    public function setThreadPool(SingaThreadPool $threadPool);
	
    public function getThreadPool();
}
?>