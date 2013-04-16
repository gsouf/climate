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
        
        
        
        try{
            $params=self::$routeur->route(self::$args);
            
            $className  = "\\Controller\\".$params['controller'];
            $action     = $params['action'];

            if(class_exists($className)){
                if(method_exists($className, $action)){
                    $c=new $className();
                    $c->$action();
                }else{
                    throw new \Climat\Exception\RouteConfigException("Method $action doesnt exists in $className");
                }
            }else{
                throw new \Climat\Exception\RouteConfigException("Class $className doesnt exists.");
            }
            
        }  catch (\Climat\Exception\RouteConfigException $e){
            
            echo "An error has happened with the route configuration :".PHP_EOL;
            echo $e->getMessage().PHP_EOL;
            self::stop();
            
        } catch (\Exception $e){
            
            echo "Command not valid :".PHP_EOL;
            echo $e->getMessage().PHP_EOL;
            self::stop();
            
        }
        
        
        
        self::stop();
    }
    
    public static function stop(){
        
        \Climat\Log::access("Script Ended after ".(microtime()-START_SCRIPT)." seconds");  // TODO pretify the log writte
    }
    
    public static function stopOnError($message){
        
        print "Script was interrupted by an error. Consult the logs for furthers informations";
        
        self::stop();
    }
    
    
    // TODO NORMALIZE LOG ERROR WITH A LEVEL
    
}

?>
