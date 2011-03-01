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
    // Verifying datas
    //
    if( !isset($queryData->core) ) {
      throw new OException(
        'No core action asked !',
        'NO_CORE_ACTION_ASKED'
      );
    }
    
    //
    // Core methods router 
    //
    switch( $queryData->core ) {
    
      //
      // Ping process      
      //
      case 'ping' :
  
        // Do we have the user id ?
        if( !isset($queryData->from) ) {
          throw new OException(
            'No user id found to ping in !',
            'NO_USER_ID_TO_PING'
          );
        }
        
        // Ping on !
        OClients::CLIENTS[$queryData->from]->ping();
  
      break;
    
    }
    
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
   * Constructor - creates a client and add's it to the global collection (connect)
   *
   * @return OClient
  */
  public function __construct() {
  
    //
    // Creating a client id 
    //
    $idTmp = uniqid();
    
    while( isset(self::CLIENTS[$idTmp]) ) {
      $idTmp = uniqid();
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
   * User erasing process
   *
  */
  public function disconnect() {
    //
    // TO DO
    //
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
  public static function handleClients() {
    //
    // TO DO 
    //
  }
  
}