<?php 
/**
 * Ocelot - Simple real-time library
 * Early tests
 *
 * 
 *
 * http://github.com/ocelot-team/Ocelot-Library
 *
 * 2011 - Fabien Canu - Matteo Cargnelutti
 *
 * /server/config.php - Server configuration
*/

///////////////////////////////////////////////////////////////////////////////
//
// PHP Version 
//
///////////////////////////////////////////////////////////////////////////////
if( 5 < intval(substr(phpversion(), 0, 1)) ) {
  echo "PHP 5 or newer needed for Ocelot !";
  exit();
}


///////////////////////////////////////////////////////////////////////////////
//
// Script protection constant 
//
///////////////////////////////////////////////////////////////////////////////
define('OCELOT_EXECUTION', true);


///////////////////////////////////////////////////////////////////////////////
//
// Paths 
//
///////////////////////////////////////////////////////////////////////////////
define('OCELOT_CORE_PATH', dirname(__FILE__).'/core/');
define('OCELOT_MODULES_PATH', dirname(__FILE__).'/modules/');


///////////////////////////////////////////////////////////////////////////////
//
// Classes autoloader
//
///////////////////////////////////////////////////////////////////////////////
function load_classes($className)
{
    // Core  
    if( !preg_match('#mod_#', $className) ) {
      require_once( OCELOT_CORE_PATH.strtolower($className).'.class.php' );
    }
    // Modules
    else {
      require_once( OCELOT_MODULES_PATH.strtolower($className).'.class.php' );
    }

}

spl_autoload_register('load_classes');


///////////////////////////////////////////////////////////////////////////////
//
// Dependencies verification  
//
///////////////////////////////////////////////////////////////////////////////
if( !function_exists('socket_create') ) {

  throw new OException(
    "PHP\'s sockets extension not found ! Please activate the appropriate extension in your php.ini file.",
    'SOCKETS_UNAVAILABLE'
  );

}

if( !function_exists('json_encode') ) {

  throw new OException(
    "PHP\'s JSON support needed !",
    'JSON_SUPPORT_UNAVAILABLE'
  );
}


///////////////////////////////////////////////////////////////////////////////
//
// Server infos  
//
///////////////////////////////////////////////////////////////////////////////
define('OCELOT_SERVER_ID', 'ocelotTestServer');
define('OCELOT_SERVER_PORT', 2674); 
define('OCELOT_SERVER_NAME', 'Ocelot Test Server');
define('OCELOT_SERVER_PASSWORD', sha1('1234abcd'));
define('OCELOT_SERVER_CLIENT_TIMEOUT', 60); // In seconds