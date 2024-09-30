<?php
namespace lib;

require_once __DIR__ . '/JsonRpcClient.php';
require_once __DIR__ . '/Emercoin.php';
require_once __DIR__ . '/Ness.php';
require_once __DIR__ . '/Btc.php';
require_once __DIR__ . '/Tokenizer.php';

use \lib\Emercoin;
use \lib\Ness;
use \lib\Btc;
use \lib\Tokenizer;

class Container {

    public static function createEmercoin(): Emercoin
    {
        $config = require __DIR__ . '/../config/config.php';
        return new Emercoin($config['emercoin']['user'], $config['emercoin']['password'], $config['emercoin']['host'], $config['emercoin']['port']);
    }

    public static function createEmercoinDebug(): Emercoin
    {
        $config = require __DIR__ . '/../config/config.php';
        return new Emercoin($config['emercoin']['user'], $config['emercoin']['password'], $config['emercoin']['host'], $config['emercoin']['port'], true);
    }


    public static function createNess(): Ness 
    {
        $config = require __DIR__ . '/../config/config.php';
        $ness = $config['ness'];

        $ness = new Ness($ness['host'], (int) $ness['port'], [$ness['wallet_id']], $ness['password'], $ness['prefix']);

        return $ness;
    }


    public static function createBtc(): Btc 
    {
        $b = new Btc();
        return $b;
    }

    public static function createTokenizer(): Tokenizer 
    {
        return new Tokenizer(self::createEmercoin(), self::createNess(), self::createBtc());
    }
}
