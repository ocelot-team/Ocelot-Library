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
 * /core/odata.class.php - Ocelot data class  
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
  */
  public function __construct( $rawInput )
  }

  
  /**
   * Coding outgoing data 
   *
  */
  public function __toString( $raw ) {
  }
  
  public function encode() {
    return $this->__toString()
  }

  
}