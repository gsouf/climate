<?php

/**
 * @license See LICENSE
 */

namespace Climate;

use Symfony\Component\Yaml\Parser as yamlParser;

/**
 * Application starter class.
 *
 * @author Soufiane GHZAL
 */
class Application {
    
    /**
     * args given when calling the application
     * @var array 
     */
    protected static $args;
    
    /**
     * the routeur config
     * @var \Climate\Router
     */
    protected static $routeur;
    
    /**
     * Global climat configs
     * @var ApplicationConfig
     */
    protected static $ClimateConfig;
    
    /**
     * Global configs of the application
     * @var Config
     */
    protected static $config;
    
    


    public static function start($args, \Climate\Router $router){
        
        self::$args=$args; // remove the first one which is the name of the script
        self::$routeur=$router;
        
        
        
        try{
            $params=self::$routeur->route(self::$args);
            
            $className  = "\\Controller\\".$params['controller'];
            $action     = $params['action'];
            
            if("yes" === Config::debugRoutes()){
                echo PHP_EOL;            
                echo "    ========================================";
                echo PHP_EOL;            
                echo PHP_EOL;            
                echo "       RUNNING APPLICATION AS DEBUG MODE";
                echo PHP_EOL;            
                echo PHP_EOL;            
                echo "    ========================================";
                echo PHP_EOL;            
                echo PHP_EOL;            
                echo " debugRoutes mode said that routing was successful : ";
                echo PHP_EOL;
                echo PHP_EOL;
                echo "  - controller           :  ".$className;
                echo PHP_EOL;
                echo "  - action               :  ".$action;
                echo PHP_EOL;
                echo PHP_EOL;
                if(count($params['params'])>0){
                    echo "  - params     :  ";
                    foreach($params['params'] as $k=>$v){
                        echo "      - $k : $v";
                        echo PHP_EOL;
                    }
                }
                if(class_exists($className)){
                    echo "  - controller is valid  :  YES";
                    echo PHP_EOL;
                    echo "  - action is valid      :  ".(method_exists($className, $action)?"YES":"NO");
                    
                    
                }else{
                    echo "  - controller is valid  :  NO";
                }
                echo PHP_EOL;
                echo PHP_EOL;
                self::stop();
                
            }
            
            if(class_exists($className)){
                if(method_exists($className, $action)){
                    $c=new $className();
                    $c->$action();
                }else{
                    throw new \Climate\Exception\RouteConfigException("Method $action doesnt exists in $className");
                }
            }else{
                throw new \Climate\Exception\RouteConfigException("Class $className doesnt exists.");
            }
            
        }  catch (\Climate\Exception\RouteConfigException $e){
            
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
    
    
    
    public static function stop($output=null,$logMessage=""){
        
        \Climate\Log::access("Script Ended after ".(microtime()-START_SCRIPT)." seconds".(strlen($logMessage)>0?" with message : ".$logMessage:"."));  // TODO pretify the log writte
    
        exit();
    }
    
    
    
    public static function stopOnError($message){
        
        print "Script was interrupted by an error. Consult the logs for furthers informations";
        
        self::stop();
    }
    
    
    // TODO NORMALIZE LOG ERROR WITH A LEVEL
    
    
    /**
     * set the user config of the application
     * @param \Climate\Config $conf
     */
    public static function setConfig(Config $conf){
        self::$config=$conf;
    }
    
    /**
     * get the asked config from the user config
     * @param string $confName name of the user config to get
     * @return mixed value of the config or null if asked config doesnt exist
     */
    public static function conf($confName){
        return self::$config->$confName;
    }
    
    /**
     * set the climate config.
     * @param \Climate\ClimateConfig $conf
     */
    public static function setClimateConfig(ClimateConfig $conf){
        self::$ClimateConfig=$conf;
    }
    
    /**
     * get the asked config from the climate config
     * @param string $confName name of the user config to get
     * @return mixed value of the config or null if asked config doesnt exist
     */
    public static function ClimateConf($confName){
        return self::$ClimateConfig->$confName;
    }
    
    
    
}

?>
