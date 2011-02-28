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
 * /core/oclient.class.php - Ocelot Clients class  
*/

// Script protection 
if( !defined('OCELOT_EXECUTION') ) {
  echo "Access denied";
}

class OClient {

  ///////////////////////////////////////////////////////////////////////////////
  //
  // Routing 
  //
  ///////////////////////////////////////////////////////////////////////////////
  /**
   * Global router - Redirects to a given action according to the transmited datas
   *
   * @param JSON $queryData
   * @return void 
   * @throw OException
  */
  public static function router( $queryData ) {
    //
    // TO DO 
    //
  }
  
  
  ///////////////////////////////////////////////////////////////////////////////
  //
  // Attributes 
  //
  ///////////////////////////////////////////////////////////////////////////////
  
  //  
  // Single client attributes 
  //
  private $id; // is not linear =)
  private $firstPing;
  private $lastPing;
  
  //
  // Clients collection
  //
  private static $CLIENTS = array(); // Array of Oclient
 
 
  ///////////////////////////////////////////////////////////////////////////////
  //
  // Instanciated Client handling 
  //
  ///////////////////////////////////////////////////////////////////////////////
   
  /**
   * Constructor - creates a client and add's it to the global collection 
   *
   * @return OClient
  */
  public function __construct() {
  
    //
    // Creating a client id 
    //
    $idTmp = md5( rand(0,10000).''.time() );
    
    while( isset(self::CLIENTS[$idTmp]) ) {
      $idTmp = md5( rand(0,10000).''.time() );
    }
    
    //
    // Pings
    //
    $this->id = $idTmp;
    $this->firstPing = time();
    $this->lastPing = time();
    
    //
    // Associating the user to the global collection 
    //
    self::CLIENTS[$idTmp] = $this;
    
  }
  
  
  /**
   * Ping process 
   *
  */
  public function ping() {
    //
    // TO DO 
    //
  }
  
  
  /**
   * Global get accessor
   *
   * @param string $attr
   * @return mixed
   * @throws Exception
  */
  public function __get( $attr ) {
  
    if( isset($this->$attr) ) {
      return $attr;
    }
    else {
      throw new Exception('The '.htmlspecialchars($attr).' attribute doesn\'t exist in '.__CLASS__.'.');
    }
  
  }
  
  
  ///////////////////////////////////////////////////////////////////////////////
  //
  // Clients collection handling 
  //
  ///////////////////////////////////////////////////////////////////////////////
  
  /**
   * Clients handler ( sort connected/timed out users, etc ...)
   *
  */
  public static function clientsHandler() {
    //
    // TO DO 
    //
  }
  
}