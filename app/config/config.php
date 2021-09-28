<?php
//App Root
//Change root C:\xampp\htdocs\Shareposts\app\config -> C:\xampp\htdocs\Shareposts\app\ 
/*Define constant App root*/
define('APP_ROOT', dirname( dirname(__FILE__) ) );  
//define URL Root
/*define('URL_ROOT', 'http://localhost/Shareposts');*/
define('URL_ROOT', 'https://myshareposts.herokuapp.com');
//Site Name
define('SITE_NAME', 'Shareposts');

//DB Params
/*define('DB_HOST', 'localhost');*/
/*define('DB_USER', 'root');*/
/*define('DB_PASS', 'ACM1PT');*/
/*define('DB_NAME', 'sharepost');*/
define('DB_HOST', 'us-cdbr-east-04.cleardb.com');
define('DB_USER', 'b49a33ca991edc');
define('DB_PASS', '0d848667');
define('DB_NAME', 'heroku_1a79350df9cda7d');
define('CHARSET', 'utf8');

//Version site App
define('APP_VERSION', '1.0.0');
