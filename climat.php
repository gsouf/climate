<?php 
/*
                                _
                               (  )
                            ( `  ) . )
                          (_, _(  ,_)_)

      ___           ___                   ___           ___           ___     
     /\  \         /\__\      ___        /\__\         /\  \         /\  \    
    /::\  \       /:/  /     /\  \      /::|  |       /::\  \        \:\  \   
   /:/\:\  \     /:/  /      \:\  \    /:|:|  |      /:/\:\  \        \:\  \  
  /:/  \:\  \   /:/  /       /::\__\  /:/|:|__|__   /::\~\:\  \       /::\  \ 
 /:/__/ \:\__\ /:/__/     __/:/\/__/ /:/ |::::\__\ /:/\:\ \:\__\     /:/\:\__\
 \:\  \  \/__/ \:\  \    /\/:/  /    \/__/~~/:/  / \/__\:\/:/  /    /:/  \/__/
  \:\  \        \:\  \   \::/__/           /:/  /       \::/  /    /:/  /     
   \:\  \        \:\  \   \:\__\          /:/  /        /:/  /     \/__/      
    \:\__\        \:\__\   \/__/         /:/  /        /:/  /                 
     \/__/         \/__/                 \/__/         \/__/                
                                                    
                                     
                                        _ . 
                                      (  _ )_                     
                                    (_  _(_ ,)
                                                             |
               _  _                                        \ _ /
              ( `   )_                                   -= (_) =-
             (    )    `)                                  /   \
           (_   (_ .  _) _)                                  |


*/


/**
 * Define Begin of Script for Stats
 */
define("START_SCRIPT", microtime());

/**
 * Set Basepath to Root of Application. It makes includes easier .
 */
chdir(dirname("."));
 
/**
 * Get Composer Autoloader because it just works like a charm :)
 */
require_once "vendor/autoload.php";





/*==============================
 *                             =
 * Get and Parse the route.yml =
 *                             =
 *******************************/
$routeFile="application/route.yml";



$routeArray=(new Symfony\Component\Yaml\Parser())->parse(file_get_contents($routeFile));

$router=new \Climat\Router($routeArray);


App\Application::start(array_slice($argv,1),$router);