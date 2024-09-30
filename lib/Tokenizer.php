<?php
namespace lib;

require_once __DIR__ . '/Emercoin.php';
require_once __DIR__ . '/Ness.php';

use \lib\Emercoin;
use \lib\Ness;


/**
 *
 * @author Aleksej Sokolov <aleksej000@gmail.com>,<chosenone111@protonmail.com>
 */
class Tokenizer {

    private $emc;
    private $ness;
    private $btc;

    public function __construct(Emercoin $emc, Ness $ness, Btc $btc)
    {
      $this->emc = $emc;
      $this->ness = $ness;
      $this->btc = $btc;

      if (!$this->ness->health()) {
        throw new \Exception("Ness connection error");
      }

      $this->emc->getinfo();
    }

    public function listTokens()
    {
      return $this->emc->name_filter("^token:exchange:privateness1:.+$");
    }

    public function showToken(string $name)
    {
      try {
        return $this->emc->name_show($name);
      } catch (\Throwable $th) {
        return false;
      }
    }

    public function listPayedTokens()
    {
      $tokens = $this->listTokens();
      $payed_tokens = [];
  
      foreach ($tokens as $token) {
          $token_name = explode(':', $token['name']);
          if (count($token_name) > 3) {
            $token_ness_addr = $token_name[3];
            $token_value = json_decode($token['value'], true);

            $token_ness_balance = $this->checkNESSbalance($token_ness_addr);
    
            if (false !== $token_value && $token_ness_balance > 0) {
              $token_value['ness_addr'] = $token_ness_addr;
              $token_value['ness_balance'] = $token_ness_balance;
              $token_value['btc_balance'] = $token_ness_balance / 1000000;
              $payed_tokens[] = $token_value;
            }
          }
      }

      return $payed_tokens;
    }

    private function generateRandomString($length = 10) {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
  
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[random_int(0, $charactersLength - 1)];
      }
  
      return $randomString;
    }

    private function generateRandomTake($length = 10) 
    {
      $takes = [];
      for ($i = 0; $i < $length; $i++) {
        $takes[] = $this->generateRandomString(random_int(2, 10));
      }

      return implode(' ', $takes);
    }

    public function listRandomTokens()
    {
      $tokens = [];

      for ($i = 0; $i < 100; $i++) {
        $ness_balance = random_int(1000, 100000);
        $tokens[] = [
          'name' => $this->generateRandomString(random_int(5, 20)),
          'message' => $this->generateRandomTake(random_int(10, 20)),
          'btc_addr' => 'bc1qeq0smm86zqwv3s2e9fsd956knvrah0t9pfmwxm',
          'ness_addr' => '2mYszc5NkmAd96jQCnEoo4RcDr6gfZvG1GF',
          'ness_balance' => $ness_balance,
          'btc_balance' => $ness_balance / 1000000
        ];
      }

      return $tokens;
    }

    public function findFreeBTCaddr()
    {

      $nvs_value = $this->emc->name_show("exchange:privateness1:BTC:NESS");
      $nvs_value = $nvs_value['value'];
      $data = json_decode((string) $nvs_value, true);

      if (false !== $data) {
        $tokens = $this->listTokens();

        $exchange_addresses = $data['addresses']['btc'];
        $token_addresses = [];
  
        foreach ($tokens as $token) {
            $token_value = json_decode($token['value'], true);
    
            if (false !== $token_value && isset($token_value['btc_addr'])) {
              $token_addresses[] = $token_value['btc_addr'];
            }
        }

        foreach ($exchange_addresses as $exchange_addr) {
          if (!in_array($exchange_addr, $token_addresses)) {
            return $exchange_addr;
          }
        }
      }
    }

    public function findFreeEMCaddr()
    {
      $nvs_value = $this->emc->name_show("exchange:privateness1:BTC:NESS");
      $nvs_value = $nvs_value['value'];
      $data = json_decode((string) $nvs_value, true);

      if (false !== $data) {
        $exchange_addresses = $data['addresses']['emc'];
        $token_addresses = [];

        $tokens = $this->listTokens();

        // if (count($tokens) < count($exchange_addresses)) {
        //   return $exchange_addresses[count($tokens)];
        // }

        foreach ($tokens as $token) {
          $token_addresses[] = $this->showToken($token['name'])['address'];
        }

        foreach ($exchange_addresses as $exchange_addr) {
          if (!in_array($exchange_addr, $token_addresses)) {
            return $exchange_addr;
          }
        }
      }

      return false;
    }

    public function tokensCount()
    {
      return count($this->listTokens());
    }

    public function freeTokensLeft()
    {
      $nvs_value = $this->emc->name_show("exchange:privateness1:BTC:NESS");
      $nvs_value = $nvs_value['value'];
      $data = json_decode((string) $nvs_value, true);

      if (false !== $data) {
        $exchange_addresses = $data['addresses']['emc'];

        return count($exchange_addresses) - $this->tokensCount();
      }

      return False;
    }

    public function checkNESSbalance(string $addr): float
    {
      return (float) $this->ness->getAddress($addr)['confirmed']['coins'] / 1000000;
    }

    public function checkBTCbalance(string $addr)
    {
      return $this->btc->getAddressBalance($addr);
    }

    public function takeOUT(string $name, string $addr)
    {
      $nvs_value = $this->emc->name_show($name);
      $this->emc->name_update($name, $nvs_value, 100, $addr);
    }

    public function NessAddrExists(string $ness_addr)
    {
      return $this->ness->checkAddress($ness_addr);
    }

    public function createToken(string $ness_addr, string $name, string $message)
    {
      $free_btc_addr = $this->findFreeBTCaddr();
      $free_emc_addr = $this->findFreeEMCaddr();

      $nvs_name = "token:exchange:privateness1:" . $ness_addr;

      $nvs_value = [
        "name" => $name,
        "message" => $message,
        "btc_addr" => $free_btc_addr
      ];

      return $this->emc->name_new($nvs_name, json_encode($nvs_value), 10000, $free_emc_addr);
    }

    public function findToken(string $ness_addr)
    {
      if (! $this->NessAddrExists($ness_addr)) {
        $token_data['status'] = 'not_found';
        return $token_data;
      }

      $token = $this->showToken("token:exchange:privateness1:" . $ness_addr);

      if (false === $token) {
        $token_data['status'] = 'found';
        return $token_data;
      }

      $token_data = json_decode((string) $token['value'], true);

      $token_data['ness_addr'] = $ness_addr;
      
      $token_data['ness_balance'] = $this->checkNESSbalance($ness_addr);

      $token_data['btc_balance'] = $this->checkBTCbalance($token_data['btc_addr']);

      if ($token_data['ness_balance'] > 0) {
        $token_data['status'] = 'completed';
      } elseif (0 == $token_data['ness_balance'] && $token_data['btc_balance'] > 0) {
        $token_data['status'] = 'payed';
      } elseif (0 == $token_data['btc_balance']) {
        $token_data['status'] = 'created';
      }

      return $token_data;
    }

}