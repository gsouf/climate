<?php

/**
 * @license See LICENSE
 */

namespace Climate;
/**
 * Description of Config
 *
 * @author Soufiane GHZAL
 */
abstract class Config {
    
    private static $neededConfigs=["accessLog","errorLog","routesFile","sendEmailOnError"];
    private static $config=[];


    public static function build($configArray){

        foreach(self::$neededConfigs as $conf){
            if(!isset($configArray[$conf]))
                throw new \Exception ("Config $conf is missing");
        }
        
        self::$config=$configArray;
    }
    
    public static function __callStatic($name,$arg) {
        
        if(!isset(self::$config[$name]))
            return null;
        
        return self::$config[$name];
        
    }
    
}

?>
