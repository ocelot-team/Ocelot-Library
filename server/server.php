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
 * /server/server.php - Real server script to instanciate
*/


try {

  ///////////////////////////////////////////////////////////////////////////////
  //
  // Config handling 
  //
  ///////////////////////////////////////////////////////////////////////////////
  include_once('config.php');

  
  ///////////////////////////////////////////////////////////////////////////////
  //
  // Restricted access : shell, with password
  //
  ///////////////////////////////////////////////////////////////////////////////
  if( isset($_SERVER['argv']) && $_SERVER['argc'] > 1 && sha1($_SERVER['argv'][1]) === OCELOT_SERVER_PASSWORD ) {
    
    // If the authentication is okay, we show a welcomme message
    echo "[OCELOT SERVER] "
    .date('d/m/Y H:i',time())
    .' - Welcomme to '.OCELOT_SERVER_NAME.".\n"
    ."Launched at port ".OCELOT_SERVER_PORT."\n\n";
    
  } 
  // In case of authentication error 
  else {
  
    echo "[OCELOT SERVER] "
    .date('d/m/Y H:i',time())
    ." - Access denied to the server !\nWrong password or non-shell access.\n\n";
    exit();
    
  }  
  
  ///////////////////////////////////////////////////////////////////////////////
  //
  // Socket handling 
  //
  ///////////////////////////////////////////////////////////////////////////////
  
  //
  // Server global datas 
  //
  $GLOBALS['o_server'] = null; // Server socket 
  
  
  //
  // Server launching 
  //
  $GLOBALS['o_server'] = socket_create_listen( OCELOT_SERVER_PORT );

  // Is the server correctly launched ? 
  if( !is_resource($GLOBALS['o_server']) ) {
  
    throw new OcelotException(
      'Unable to launch the server at port '.OCELOT_SERVER_PORT." :\n".socket_strerror(socket_last_error())."\n",
      'SERVER_LAUNCHING_ERROR'
    );
  
  }
  
  
  //
  // Clients waiting and routing
  //
  while( $clientTmp = socket_accept( $GLOBALS['o_server'] ) ) {
  
    //
    // Incoming connexion signal 
    //
    echo date('d/m/Y H:i',time())." - Incoming connexion.\n";
  
  
    //
    // Datas catching 
    //
    $rawIncoming = socket_read( $clientTmp, 10000 );

    
    //
    // Clients sorting / managing
    //
    OClients::handleClients();

    
    //
    // Finding the action the client want to execute and launching it
    //
    $incoming = json_decode($rawIncoming);

    
    //
    // Connect 
    //
    if( isset($incoming->core) && 'connect-asker' == $incoming->core ) {
    
      // Sending the answer back to the client 
      socket_write( $clientTmp, OClient::connect( $incoming->ip ) );

    }
    
    
    //
    // Other actions 
    //
    elseif( isset($incoming->hanlder) && strlen($incoming->handler) > 0 ) {
    
      $request = null;
      $answer = null;
    
      //
      // Instanciating datas request  
      //
      $request = new OData( $rawIncoming );
      
      //
      // TO DO : data transert and modules handling 
      //
    
      //
      // Returning back the infos 
      //
      socket_write( $clientTmp, OData::encode($answer) ); 
      
    }
    
    
    //
    // Client socket shutdown 
    //
    socket_close( $clientTmp );
  
  }
  
}
///////////////////////////////////////////////////////////////////////////////
//
// Main Exception Catcher
//
///////////////////////////////////////////////////////////////////////////////
catch( Exception $e ) {
  $e->getMessage();
  exit();
}