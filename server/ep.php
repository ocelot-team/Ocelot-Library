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
 * /server/ep.php - Client to server entry point 
*/

//
// /!\ TESTS /!\ 
// /!\ TESTS /!\ 
// /!\ TESTS /!\ 
// /!\ TESTS /!\ 
// /!\ TESTS /!\ 
//
try {

  // [TEMP] Server connect 
  $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP); // In real conditions, we would verify this !
  socket_connect($socket, '127.0.0.1', 2674); // In real conditions, we would verify this !
 
  
}
catch( Exception $e ) {
  echo $e->getMessage();
  exit;
}
//
// /!\ TESTS /!\ 
// /!\ TESTS /!\ 
// /!\ TESTS /!\ 
// /!\ TESTS /!\ 
// /!\ TESTS /!\ 
//