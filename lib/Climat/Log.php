<?php

namespace Climat;

use Monolog\Logger;


/**
 * Description of Logger
 *
 * @author bobito
 */
class Log {
    
    /**
     *
     * @var Logger[]
     */
    protected static $loggers=[];
    
    public static function add($name,Logger $logger){
    
        self::$loggers[$name]=$logger;
        
    }
    
    public static function __callStatic($name, $arguments) {
        if(!isset(self::$loggers[$name]))
            throw new Exception("Logger $name doesn't exist");
        
        self::$loggers[$name]->log(100,$arguments[0]);
    }
    
}

?>
