<?php 
namespace lib;

require_once __DIR__ . '/JsonRpcClient.php';

use \lib\JsonRpcClient;

/**
 * Emercoin RPC module
 *
 * @author Aleksej Sokolov <aleksej000@gmail.com>,<chosenone111@protonmail.com>
 */
class Emercoin {
  private $username = '';
  private $password = '';
  private $address = 'localhost';
  private $port = '8332';
  private $rpcClient;
  private $debug = false;


  public function __construct(string $username, string $password, string $address, int $port, $debug = false)
  {
    $this->username = $username;
    $this->password = $password;
    $this->address = $address;
    $this->port = $port;
    $this->debug = $debug;
  }

  /**
   * Returns an object containing various state info.
   * @return array 
   */
  public function getinfo()
  {
    $url = $this->username.':'.$this->password.'@'.$this->address.':'.$this->port.'/';
    $this->rpcClient = new JsonRpcClient($url, $this->debug);
    return $this->rpcClient->getinfo();
  }
  
  /**
   * Create account or return an existing account address
   * @param string $account
   * @return address
   * @throws Exception
   */
  public function getAccountAddress($account)
  {
    $url = $this->username.':'.$this->password.'@'.$this->address.':'.$this->port.'/';
    $this->rpcClient = new JsonRpcClient($url, $this->debug);
    
    return $this->rpcClient->getaccountaddress($account);
  }
  
  public function listaccounts()
  {
    $url = $this->username.':'.$this->password.'@'.$this->address.':'.$this->port.'/';
    $this->rpcClient = new JsonRpcClient($url, $this->debug);
    
    return $this->rpcClient->listaccounts();
  }
  
  public function listAccountsAddresses()
  {  
    $accounts = self::listaccounts();
    $result = array();
      
    foreach ($accounts as $account => $ammount) {
        $result[$account] = self::getAddressesByAccount($account);
    }
    
    return $result;
  }
  
  public function getFirstAddress()
  {  
    $accounts = self::listaccounts();
      
    foreach ($accounts as $account => $ammount) {
        $addresses = self::getAddressesByAccount($account);
        foreach ($addresses as $addr) {
            $address = $addr;
        }
    }
    return $address;
  }
  
  /**
   * All Addresses by account
   * @param type $account
   * @return type
   */
  public function getAddressesByAccount($account)
  {
    $url = $this->username.':'.$this->password.'@'.$this->address.':'.$this->port.'/';
    $this->rpcClient = new JsonRpcClient($url, $this->debug);
    
    return $this->rpcClient->getaddressesbyaccount($account);
  }
  
  
  /**
   * Return the balance from account
   * @param type $account
   * @return float
   */
  public function getAccauntBalance($account)
  {
    $url = $this->username.':'.$this->password.'@'.$this->address.':'.$this->port.'/';
    $this->rpcClient = new JsonRpcClient($url, $this->debug);
    
    return $this->rpcClient->getbalance($account);
  }
  
  /**
   * Return total from the wallet
   * @return float
   */
  public function getAllBalance()
  {
    $url = $this->username.':'.$this->password.'@'.$this->address.':'.$this->port.'/';
    $this->rpcClient = new JsonRpcClient($url, $this->debug);
    
    return $this->rpcClient->getbalance();
  }
  
  /**
   * Send some EMC to address
   * 
   * @param type $emercoinaddress
   * @param type $amount
   * @param type $account - send account from
   * @return type 
   */
  public function sendToAddress($emercoinaddress, $amount, $account = '')
  {
    $url = $this->username.':'.$this->password.'@'.$this->address.':'.$this->port.'/';
    $this->rpcClient = new JsonRpcClient($url, $this->debug);
    
    if($account == '') {
      return $this->rpcClient->sendtoaddress($emercoinaddress, (double)$amount);
    }
    else {
      return $this->rpcClient->sendfrom($account, $emercoinaddress, (double)$amount);
    }
  }
  
  /**
   * Send ALL your EMC to address
   * @param type $emercoinaddress
   * @return type
   */
  public function sendAllToAddress($emercoinaddress)
  {
    $url = $this->username.':'.$this->password.'@'.$this->address.':'.$this->port.'/';
    $this->rpcClient = new JsonRpcClient($url, $this->debug);
    
    $amount = self::getAllBalance();
    
    return $this->rpcClient->sendtoaddress($emercoinaddress, (double)$amount);
  }
  
  /**
   * 
   * @param type $account
   * @return type 
   */
  public function createNewAddress($account)
  {
      $url = $this->username.':'.$this->password.'@'.$this->address.':'.$this->port.'/';
      $this->rpcClient = new JsonRpcClient($url, $this->debug);

      return $this->rpcClient->getnewaddress($account);
  }
  
  /**
   * Total recieved by address
   * @param type $emercoinaddress
   * @return type
   */
  public function getRecievedByAddress($emercoinaddress)
  {
    $url = $this->username.':'.$this->password.'@'.$this->address.':'.$this->port.'/';
    $this->rpcClient = new JsonRpcClient($url, $this->debug);
    
    return $this->rpcClient->getreceivedbyaddress($emercoinaddress);
  }
  
  /**
   * Trasaction list
   * @param type $account
   * @param type $count
   * @return array
   */
  public function listtransactions($account, $count = 1000)
  {
    $url = $this->username.':'.$this->password.'@'.$this->address.':'.$this->port.'/';
    $this->rpcClient = new JsonRpcClient($url, $this->debug);
    
    return $this->rpcClient->listtransactions($account, $count);
  }  
  
  /**
   * Last transaction
   * @param type $account
   * @param type $address
   * @param type $count
   * @return type
   */
  public function getLastReceivedTransaction($account, $address, $count = 1000)
  {
    //echo " getLastReceivedTransaction($account, $address, $count = 1000) ";
    $transactions = self::listtransactions($account, $count);
    //var_dump($transactions);
    $tx_hight = count($transactions) - 1;
    for($i = $tx_hight; $i >= 0; $i--) {
      if(($transactions[$i]['category'] == 'receive') && ($transactions[$i]['address'] == $address)) {
        return $transactions[$i];
      }
    }
  }  

  /**
   * Sign a message with the private key of an address
        Requires wallet passphrase to be set with walletpassphrase call.
   * @param type $emercoinaddress The emercoin address to use for the private key.
   * @param type $message The message to create a signature of.
   * @return type
   */
  public function signmessage($emercoinaddress, $message)
  {
    $url = $this->username.':'.$this->password.'@'.$this->address.':'.$this->port.'/';
    $this->rpcClient = new JsonRpcClient($url, $this->debug);
    
    return $this->rpcClient->signmessage($emercoinaddress, $message);
  }


  /**
   * Verify a signed message
   * @param type $emercoinaddress The emercoin address to use for the signature.
   * @param type $signature The signature provided by the signer in base 64 encoding (see signmessage).
   * @param type $message The message that was signed.
   * @return type
   */
  public function verifymessage($emercoinaddress, $signature, $message)
  {
    $url = $this->username.':'.$this->password.'@'.$this->address.':'.$this->port.'/';
    $this->rpcClient = new JsonRpcClient($url, $this->debug);
    
    return $this->rpcClient->verifymessage($emercoinaddress, $signature, (string)$message);
  }

  /**
   * scan and filter names
   * name_filter "" 5 # list names updated in last 5 blocks
   * name_filter "^id/" # list all names from the "id" namespace
   * name_filter "^id/" 0 0 0 stat # display stats (number of names) on active names from the "id" namespace
   * @param type $regexp apply [regexp] on names, empty means all names
   * @param int $maxage look in last [maxage] blocks
   * @param int $from show results from number [from]
   * @param int $nb show [nb] results, 0 means all
   * @param type $stat show some stats instead of results
   * @param type $valuetype if "hex" or "base64" is specified then it will print value in corresponding format instead of string.

   * @return array
   */
  public function name_filter( $regexp, $maxage=0, $from=0, $nb=0, $stat='', $valuetype=''): array
  {
    $url = $this->username.':'.$this->password.'@'.$this->address.':'.$this->port.'/';
    $this->rpcClient = new JsonRpcClient($url, $this->debug);

    if(!empty($valuetype)) {
        return $this->rpcClient->name_filter( $regexp, $maxage, $from, $nb, $stat, $valuetype);
    }
    elseif(!empty($stat)) {
        return $this->rpcClient->name_filter( $regexp, $maxage, $from, $nb, $stat);
    }
    else {
        return $this->rpcClient->name_filter( $regexp, $maxage, $from, $nb);
    }
  }
  
  /**
   * Look up the current and all past data for the given name.
   * @param type $name
   * @param type $fullhistory
   * @param type $valuetype
   * @return type
   */
  public function name_history( $name , $fullhistory, $valuetype)
  {
    $url = $this->username.':'.$this->password.'@'.$this->address.':'.$this->port.'/';
    $this->rpcClient = new JsonRpcClient($url, $this->debug);
    
    return $this->rpcClient->name_history( $name , $fullhistory, $valuetype);
  }
  
  /**
   * list pending name transactions in mempool.
   * @param type $valuetype
   * @return type
   */
  public function name_mempool( $valuetype )
  {
    $url = $this->username.':'.$this->password.'@'.$this->address.':'.$this->port.'/';
    $this->rpcClient = new JsonRpcClient($url, $this->debug);
    
    return $this->rpcClient->name_mempool($valuetype);
  }
  
  /**
   * Scan all names, starting at start-name and returning a maximum number of entries (default 500)
   * @param type $start_name
   * @param type $max_returned
   * @param type $max_value_length
   * @param type $valuetype
   * @return type
   */
  public function name_scan( $start_name, $max_returned, $max_value_length=-1, $valuetype='')
  {
    $url = $this->username.':'.$this->password.'@'.$this->address.':'.$this->port.'/';
    $this->rpcClient = new JsonRpcClient($url, $this->debug);
    
    return $this->rpcClient->name_scan($start_name, $max_returned, $max_value_length, $valuetype);
  }
  
    /**
   * List my own names.
   * @param type $name (string, required) Restrict output to specific name
   * @param type $valuetype (string, optional) If "hex" or "base64" is specified then it will print value in corresponding format instead of string.
   * @return type
   */
  public function name_list( $name='', $valuetype='')
  {
    $url = $this->username.':'.$this->password.'@'.$this->address.':'.$this->port.'/';
    $this->rpcClient = new JsonRpcClient($url, $this->debug);
    
    if (('' === $name) && ('' === $valuetype)) {
      return $this->rpcClient->name_list();
    } elseif ('' === $valuetype) {
      return $this->rpcClient->name_list($name);
    } else {
      return $this->rpcClient->name_list($name, $valuetype);
    }
  }
  
  /**
   * List my own names (filtered).
   * @param string $name_start first part of a name
   * @param type $valuetype
   */
  public function name_list_filtered( $name_start, $valuetype='')
  {
      $records = self::name_list("", $valuetype);
      $result = array();
      
      foreach ($records as $record) {
          if(strpos($record['name'], $name_start) === 0) {
              $result[] = $record;
          }
      }
      
      return $result;
  }
  
  /**
   * Show values of a name.
   * @param type $name
   * @param type $valuetype If "hex" or "base64" is specified then it will print value in corresponding format instead of string.
   * @param type $filepath save name value in binary format in specified file (file will be overwritten!).
   * @return type
   */
  public function name_show( $name, $valuetype='', $filepath='')
  {
    $url = $this->username.':'.$this->password.'@'.$this->address.':'.$this->port.'/';
    $this->rpcClient = new JsonRpcClient($url, $this->debug);
    
    if(!empty($filepath)) {
        return $this->rpcClient->name_show($name, $valuetype, $filepath);
    }
    elseif(!empty($valuetype)) {
        return $this->rpcClient->name_show($name, $valuetype);
    }
    else {
        return $this->rpcClient->name_show($name);
    }
    
    
  }
  
  public function name_new($name, $value, $days, $toaddress = '', $valuetype = "")
  {
    $url = $this->username.':'.$this->password.'@'.$this->address.':'.$this->port.'/';
    $this->rpcClient = new JsonRpcClient($url, $this->debug);
    
    //return $this->rpcClient->name_new($name, $value, $days);
    
    if(!empty($toaddress)) {
        return $this->rpcClient->name_new($name, $value, $days, $toaddress);
    }
    elseif(!empty($valuetype)) {
        return $this->rpcClient->name_new($name, $value, $days, $toaddress, $valuetype);
    }
    else {
        return $this->rpcClient->name_new($name, $value, $days);
    }
  }
  
  public function names_new($values, $days, $toaddress = '', $valuetype = "")
  {
    $url = $this->username.':'.$this->password.'@'.$this->address.':'.$this->port.'/';
    $this->rpcClient = new JsonRpcClient($url, $this->debug);
    
    //return $this->rpcClient->name_new($name, $value, $days);
    
    if(!empty($toaddress)) {
        foreach ($values as $name => $value)
            $this->rpcClient->name_new($name, $value, $days, $toaddress);
    }
    elseif(!empty($valuetype)) {
        foreach ($values as $name => $value)
            $this->rpcClient->name_new($name, $value, $days, $toaddress, $valuetype);
    }
    else {
        foreach ($values as $name => $value)
            $this->rpcClient->name_new($name, $value, $days);
    }
  }
  
  public function name_update( $name, $value, $days, $toaddress='', $valuetype='')
  {
    $url = $this->username.':'.$this->password.'@'.$this->address.':'.$this->port.'/';
    $this->rpcClient = new JsonRpcClient($url, $this->debug);
    
    //return $this->rpcClient->name_update($name, $value, $days);
    
    if(!empty($toaddress)) {
        return $this->rpcClient->name_update($name, $value, $days, $toaddress);
    }
    elseif(!empty($valuetype)) {
        return $this->rpcClient->name_update($name, $value, $days, $toaddress, $valuetype);
    }
    else {
        return $this->rpcClient->name_update($name, $value, $days);
    }
  }
  
  public function name_delete( $name )
  {
    $url = $this->username.':'.$this->password.'@'.$this->address.':'.$this->port.'/';
    $this->rpcClient = new JsonRpcClient($url, $this->debug);
    
    return $this->rpcClient->name_delete( $name );
  }
}
