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


/*===============================
 *                              =
 *     Prepares the Configs     =
 *                              =
 ********************************/
$configsFile = "application/climat.config.yml";
$configArray = (new Symfony\Component\Yaml\Parser())->parse(file_get_contents($configsFile));

Climat\Config::build($configArray);





/*===============================
 *                              =
 *       Prepare loggers        =
 *                              =
 ********************************/

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// =============
// Error Log
$logE = new Logger('error');

//Log file
$logE->pushHandler(new StreamHandler(Climat\Config::errorLog()));

//Email
if("yes" === Climat\Config::sendEmailOnError() && Climat\Config::sendEmailOnErrorTo()) // if config said to send a mail when an error happens
    $logE->pushHandler(new Monolog\Handler\NativeMailerHandler(Climat\Config::sendEmailOnErrorTo(),"Climat got an error during execution","Climat App"));
//Add to the available logs
Climat\Log::add('error', $logE);


// =============
// Access Log
$logA = new Logger('access');
$logA->pushHandler(new StreamHandler(Climat\Config::accessLog()));
Climat\Log::add('access', $logA);



/*===============================
 *                              =
 *   Set Handlers for Errors    =
 *                              =
 ********************************/
set_exception_handler(function(Exception $e){
    Climat\Log::error("Uncaught exception has stopped the script with the message '"
            .$e->getMessage()."' in the file "
            .$e->getFile().":"
            .$e->getLine());
    
});

throw new Exception("blabla");
/*===============================
 *                              =
 * Get and Parse the yaml route =
 *                              =
 ********************************/
$routeFile=Climat\Config::routesFile();

$routeArray=(new Symfony\Component\Yaml\Parser())->parse(file_get_contents($routeFile));

$router=new \Climat\Router($routeArray);


/*==============================
 *                             =
 * Let's Start the Application =
 *                             =
 *******************************/

App\Application::start(array_slice($argv,1),$router);