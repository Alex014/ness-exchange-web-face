<?php
namespace lib;
class Btc {

  public function getAddressBalance(string $addr): float
  {
    $data = file_get_contents("https://blockchain.info/rawaddr/" . $addr);
    $json = json_decode($data, true);

    return (float) $json['final_balance'] / 100000000;
  }
}
