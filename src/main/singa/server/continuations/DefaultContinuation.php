<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
// +----------------------------------------------------------------------+
// | PHP version 5                                                        |
// +----------------------------------------------------------------------+
// | Copyright 2005-2006 the Seasar Foundation and the Others.            |
// +----------------------------------------------------------------------+
// | Licensed under the Apache License, Version 2.0 (the "License");      |
// | you may not use this file except in compliance with the License.     |
// | You may obtain a copy of the License at                              |
// |                                                                      |
// |     http://www.apache.org/licenses/LICENSE-2.0                       |
// |                                                                      |
// | Unless required by applicable law or agreed to in writing, software  |
// | distributed under the License is distributed on an "AS IS" BASIS,    |
// | WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND,                        |
// | either express or implied. See the License for the specific language |
// | governing permissions and limitations under the License.             |
// +----------------------------------------------------------------------+
// | Authors: nowel                                                       |
// +----------------------------------------------------------------------+
// $Id: $
//
/**
 * Continuation $_object: between start to shutdown
 * @author nowel
 */
class SingaDefaultContinuationImpl implements SingaContinuation {
    
    protected $_new = false;
    protected $_resumed = false;
    protected $_object = null;
    protected $cc;
    
    protected $id;
    protected $stack = array();
    
    public function __construct(SingaContinuation $cc = null){
        if($cc === null){
            $this->_cc = $this;
        } else {
            $this->_cc = $cc;
        }
    }
    
    public function __destruct(){
        unset($this->_cc, $this->stack, $this->_cc->_object);
    }
    
    protected function push(){
        $t = clone $this->_cc;
        $t->_object = clone $this->_cc->_object;
        $this->stack[] = $t;
    }
    
    protected function pop(){
        $t = array_pop($this->stack);
        $this->_cc = $t;
    }
    
    public function isNew(){
        return $this->_cc->_new;
    }
    
    public function start(){
        $this->id = uniqid();
    }
    
    public function shutdown(){
        $this->_new = false;
        $this->_resumed = false;
        //$this->_cc->_object = null;
        $this->stack = array();
        //$this->_cc = new self();
        return $this->id;
    }
    
    public function resume(){
        $this->_cc->_resumed = true;
        $this->pop();
    }
    
    public function suspend($timeout){
        if ($timeout < 0){
            throw new SingaIllegalArgumentException();
        }
        
        $this->_cc->_new = false;
        $result = false;
        try {
            if (!$this->_cc->_resumed && 0 < $timeout){
                $this->push();
            }
        } catch (Exception $e){
            throw new SingaRuntimeException($e);
        }
        $result = $this->_cc->_resumed;
        $this->_cc->_resumed = false;

        return $result;
    }
    
    public function reset(){
        $this->_cc->_resumed = false;
    }
    
    public function addObject(SingaContinuable $object){
        $this->_cc->_object = $object;
    }
    
    public function getObject(){
        return $this->_cc->_object;
    }
    
}

?>