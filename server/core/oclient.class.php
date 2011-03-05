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
  // Attributes 
  //
  ///////////////////////////////////////////////////////////////////////////////
  
  //  
  // Single client attributes 
  //
  private $id; // is not linear =)
  private $firstPing;
  private $lastPing;
  private $ip;
  
  //
  // Clients collection
  //
  public static $CLIENTS = array(); // Array of Oclient
 
 
  ///////////////////////////////////////////////////////////////////////////////
  //
  // Instanciated Client handling 
  //
  ///////////////////////////////////////////////////////////////////////////////
   
  /**
   * Constructor - creates a client and add's it to the global collection (connect)
   *
   * @param string $ip : The ip of the client, transmitted by ep.php
   *
   * @return OClient
  */
  public function __construct( $ip ) {
  
    //
    // Creating a client id 
    //
    $idTmp = uniqid();
    
    while( isset(self::$CLIENTS[$idTmp]) ) {
      $idTmp = uniqid();
    }
    
    $this->id = $idTmp;
    
    //
    // Pings
    //
    $this->firstPing = time();
    $this->lastPing = time();
    
    //
    // Ip 
    //
    $this->ip = $ip;
    
    //
    // Associating the user to the global collection 
    //
    self::$CLIENTS[$idTmp] = $this;
    
    //
    // Sorting clients 
    //
    ksort(self::$CLIENTS);
    
  }
  
  /**
   * Ping process 
   *
  */
  public function ping() {
    $this->lastPing = time(); 
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
   * Clients connect handler 
   *
   * @param stdObject $queryData
   * @return string - json coded 
   * @throw OException
  */
  public static function connect( $queryData ) {
    
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
    // Creating the client 
    //
    $newClient = new OClient( $queryData->ip );
    $newClientId = array_pop(array_keys(OClients::CLIENTS));
    
    //
    // Preparing the infos to send to the client 
    //
    $connectAnswer = new stdClass();
    $connectAnswer->core = 'connect-answer';
    $connectAnswer->success = is_object($newClient) ? true : false;
    $connectAnswer->id = is_object($newClient) ? $newClientId : '';
    $connectAnswer->message = is_object($newClient) ? 'Accepted' : 'Rejected';
        
    return json_encode($connectAnswer);
        
  }
  
  /**
   * Clients handler ( sort connected/timed out users, etc ...)
   * 
  */
  public static function handleClients() {
    
    // Trying to find clients that timed out 
    foreach( self::$CLIENTS as $clientId => $clientDatas ) {
    
      if( $clientDatas->lastPing + OCELOT_SERVER_CLIENT_TIMEOUT < time() ) {
      
        // Unsetting the client 
        unset( self::$CLIENTS[$clientId] );
        echo date('d/m/Y H:i',time())." - ".$cliendId." timed out.";
      }
    
    }
    
  }
  
}