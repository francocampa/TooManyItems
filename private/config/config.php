<?php
//Database params
define('DB_HOST', 'localhost'); //Add your db host
//define('DB_HOST', $_SERVER['SERVER_ADDR']); //Add your db host

//define('DB_USER', 'sysadmin'); // Add your DB root
define('DB_USER', 'root'); // Add your DB root

define('DB_PASS', ''); //Add your DB pass
define('DB_NAME', 'TooManyItems'); //Add your DB Name

//APPROOT
define('APPROOT', dirname(dirname(__FILE__)));
define('PUBLICROOT', dirname(dirname(dirname(__FILE__))))."/public";

//URLROOT (Dynamic links)
define('URLROOT', 'http://localhost/TooManyItems');
//define('URLROOT', 'http://'.$_SERVER['SERVER_ADDR'].'/TooManyItems');


//Sitename
define('SITENAME', 'TooManyItems');
