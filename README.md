CLIMATE
==========
FRAMEWORK FOR PHP CLI APPLICATIONS

----------


Climate intends to make easyest as possible the creation of CLI application using php.


Here is a quick guide for creating your new app.

Please feel free to communicate about issues or suggestions. It is everytime appreciated !

-----------------

QUICK START
======

Requirement
-----

Climate needs **php5.4** to be installed.


Install Climate
-----

First of all grab the [latest stable release][1]   and unarchive it anywhere you want. 



Now use composer to load dependencies. If you never used Composer see here : http://getcomposer.org/download/

At the root the downloaded dir : 

``` 
php -r "eval('?>'.file_get_contents('https://getcomposer.org/installer'));" 

php composer.phar install

```


Config Climate
-----------------

Go to the  ``` application ``` folder and open ``` climate.config.yml ``` 


Edit  ``` applicationName ``` and ``` applicationVersion: ``` with your application informations.


Edit  ``` accessLog ``` and ``` accessLog ``` with the paths where you want to put the logs.

DONT FORGET TO CREATE THE DIRECTORY THAT YOU SPECIFIED IN LOG CONFIGS. 
e.g If you leave the defaults values create the log dir at the root of the climate dir (not in the application dir).


You can set up email alerts and modify the used routes file (see below).

The option ``` debugRoutes ``` will allow to run the application without launching scripts in order to test safely your routes (see below)


Now come back to the root of the application and run ``` php climate.php ``` to test if your settings are ok. If so, you will have a default Climat message showing the applications works.
If it doesn't work, then look at the error (if an error is shown) else look in the log file. Most of time the application may not work because log dir is not created in the good place. If error persists feel free to open an issue.


Now you have a default working application. CONGRATS !



Now let's see how to configure you routes. That's to say the params and options that you can give when running the application.


Config Routes
-----------------


TODO



First Controller
-------------

TODO



Tools
-------------

TODO



Other Tools
-------------

TODO


[1]: https://github.com/SneakyBobito/climate/archive/v0.1.0-alpha.zip
