<?php

/**
 * @author nowel
 */
class SingaConfigure {
    
    const default_service_addr = '127.0.0.1';
    const default_service_port = 74642;
    const default_manage_port = 74643;
    const default_context_root = '/app';
    
    const key_address = 'service.addr';
    const key_service_port = 'service.port';
    const key_manage_port = 'manage.port';
    const key_context_root = 'context.root';
    
    private $addr = self::default_service_addr;
    private $port = self::default_service_port;
    private $managePort = self::default_manage_port;
    private $contextRoot = self::default_context_root;
    
    public function __construct(array $config = null){
        if(null !== $config){
            $this->addr = $config[self::key_address];
            $this->port = $config[self::key_service_port];
            $this->managePort = $config[self::key_manage_port];
            $this->contextRoot = $config[self::key_context_root];
        }
    }
    
    public function setAddress($addr){
        $this->addr = $addr;
    }
    
    public function getAddress(){
        return $this->addr;
    }
    
    public function setPort($port){
        $this->port = $port;
    }
    
    public function getPort(){
        return $this->port;
    }
    
    public function setManagePort($mport){
        $this->managePort = $mport;
    }
    
    public function getManagePort(){
        return $this->managePort;
    }
    
    public function setContextRoot($contextRoot){
        $this->contextRoot = $contextRoot;
    }
    
    public function getContextRoot(){
        return $this->contextRoot;
    }
    
    public function __toString(){
        $str = array();
        $str[] = self::key_address . '=' . $this->addr;
        $str[] = self::key_service_port . '=' . $this->port;
        $str[] = self::key_manage_port . '=' . $this->managePort;
        $str[] = self::key_context_root . '=' . $this->contextRoot;
        return '{' . explode(',', $str) . '}';
    }
    
}

?>