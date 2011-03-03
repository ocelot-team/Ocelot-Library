<?php 
/**
 * Ocelot - Simple real-time library
 * Early tests
 *
 *
 *
 * https://github.com/ocelot-team/Ocelot-Library
 *
 * 2011 - Fabien Canu - Matteo Cargnelutti
 *
 * /core/odata.class.php - Ocelot data class, normalized data exchange 
*/

// Script protection 
if( !defined('OCELOT_EXECUTION') ) {
  echo "Access denied";
}

class OData {

  //
  // Attributes
  //
  public $core; // Used to call a "core" action 
  public $from; // Sender id 
  public $to; // Receiver id 
  public $data; // stdObject containing datas  
  public $handler; // Used to call "modules" actions
  public $ping; // Last ping (timestamp)
  

  /** 
   * Decoding and instanciating incoming data 
   *
   * @param string $rawInput (json encoded)
  */
  public function __construct( $rawInput ) {
  
    //
    // Decoding datas
    //
    $request = json_decode($rawInput);
    
    foreach( $request as $k => $v ) {
      $this->$k = $v;
    }
    
    //
    // Does the ip correspond to the one given at the connection ?
    //
    if( OClients::CLIENTS[$request->from]->ip != $request->ip ) {
      
      throw new OException(
        'Client id and ip does not match !',
        'CLIENT_IP_CONFLICT'
      );
    
    }
    
    //
    // Update the clients ping ?
    //
    
    // 'From' ping 
    if( isset($request->from) && strlen($request->from) > 0 ) {
      //
      // TO DO
      //
    }
    
    // 'To' ping 
    if( isset($request->to) && strlen($request->to) > 0 ) {
      //
      // TO DO 
      //
    }
  
  }

  
  /**
   * Coding outgoing data 
   *
   * @param string $rawInput (json) 
   * @return json encoded
  */
  public function __toString( $rawInput ) {
    
    //
    // TO DO
    //
    
  }
  
  public function encode() {
    return $this->__toString()
  }

  
}