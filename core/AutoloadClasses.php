<?php

define("WWW_ROOT", __DIR__);
define("DS", DIRECTORY_SEPARATOR);

function __autoload ($class){
    $class = WWW_ROOT . DS . srt_replace('\\', DS, $class ) . '.php';
    
    if(!file_exists($class)){
        throw new Exception("File path '{$class}' not found.");
    }
    
    require_once($class);
    
}
