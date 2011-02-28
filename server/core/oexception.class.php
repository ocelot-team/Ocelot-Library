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
 * /core/oexception.class.php - Ocelot Exception handler 
*/

// Script protection 
if( !defined('OCELOT_EXECUTION') ) {
  echo "Access denied";
}

class OException {

  //
  // Attributes
  //
  private $shortCode;
  
  /**
   * Constructor 
   *
   * @param [string] $message
   * @param (opt) [string] $shortCode
   *
   * @return OcelotException 
  */
  public function __construct( $message, $shortCode ) {
  
    $this->shortCode = $shortCode;
    parent::__construct($message);
  
  }
  
  
  /**
   * Short code ascessor 
   *
   * @return string 
  */
  public function getShortCode() {
  
    return $this->shortCode;
  
  }
  
}