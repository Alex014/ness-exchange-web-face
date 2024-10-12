<?php
require_once __DIR__ . '/lib/Container.php';

use \lib\Container;

$tokenizer = Container::createTokenizer();

if ($argc == 2) {
    $ness_addr = $argv[1];

    if ( $tokenizer->NessAddrExists($ness_addr) ) {
        try {
            $tokenizer->createToken($ness_addr, "Tester", "Hello world 222");
            echo "OK";
        } catch (\Throwable $th) {
            if (false !== strpos($th->getMessage(), 'there are 1 pending operations on that name')) {
                echo "Token with addr:$ness_addr is already created or the operation is currently pending";
            } elseif (false !== strpos($th->getMessage(), 'name_new on an unexpired name')) {
                echo "Token with addr:$ness_addr already exist";
            } else {
                echo "Error: " . $th->getMessage();
            }
        }
    } else {
        echo "Address $ness_addr does not exist";
    }
}

echo "\n";
