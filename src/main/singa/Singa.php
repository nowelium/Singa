<?php

if(!defined(__DIR__)){
    define('__DIR__', dirname(__FILE__)); 
}

interface Singa {
    const Version = 1.00;
    const Loaded_Directory = __DIR__;
}

class SingaImpl implements Singa {

}

?>