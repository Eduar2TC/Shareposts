<?php
//load Config
require_once 'config/config.php';
//load libraries 
/*require_once 'libraries/Core.php';
require_once 'libraries/Controller.php';
require_once 'libraries/Database.php';
*/
//Load helpers
require_once 'helpers/url_helper.php';
require_once 'helpers/session_helper.php';
require_once 'helpers/json_helper.php';
require_once 'helpers/avatar_img_helper.php';
//AutoLoad Core Libraries
spl_autoload_register( function( $className ){
    require_once 'libraries/'. $className . '.php';
} );
