<?php 

// Load Config
require_once 'config/config.php';

// Load Libraries - Auto loading below, kept for reference
// require_once 'libraries/core.php';
// require_once 'libraries/controller.php';
// require_once 'libraries/database.php';

// Autoload Core Libraries 
spl_autoload_register( function( $className ) {
    require_once 'libraries/'. $className .'.php';
}); 
