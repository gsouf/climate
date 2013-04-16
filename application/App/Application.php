<?php

namespace App;

use Symfony\Component\Yaml\Parser as yamlParser;

/**
 * Application starter class.
 *
 * @author bobito
 */
class Application {
    
    protected static $args;
    
    /**
     * the routeur
     * @var \Climat\Router
     */
    protected static $routeur;
    
    

    public static function start($args, \Climat\Router $router){
        
        self::$args=$args; // remove the first one which is the name of the script
        self::$routeur=$router;
        
        
        $params=self::$routeur->route(self::$args);
        
        

    }
    
    
    
    
}

?>
