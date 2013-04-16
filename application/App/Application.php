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
        
        var_dump($params);
        
        self::validateStart();
    }
    
    
    /**
     * Aimed to be called just when the application starts in order 
     * to check if the call respect what we wait
     * @return boolean true if all is fine, false if something worng happens
     */
    public static function validateStart(){
        
        
        
        
    }
    
}

?>
