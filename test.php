<?php
require_once __DIR__ . '/lib/Container.php';

use \lib\Container;

$tokenizer = Container::createTokenizer();

$tokens = $tokenizer->listTokens();

print_r("Tokens:\n");
print_r($tokens);
print_r("\nFree BTC addr:\n");
print_r($tokenizer->findFreeBTCaddr());
print_r("\nFree EMC addr:\n");
print_r($tokenizer->findFreeEMCaddr());
print_r("\n");
