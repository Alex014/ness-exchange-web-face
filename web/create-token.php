<?php $__create = true; ?>
<?php require "../templates/header.php"; ?>

<?php 
require "../lib/Container.php";
use lib\Container;

$__name = '';
$__address = '';
$__value = '';
$tokens = 100;

if (isset($_POST['name']) && isset($_POST['address']) && isset($_POST['value'])) {
    $__name = (string) $_POST['name'];
    $__address = (string) $_POST['address'];
    $__value = (string) $_POST['value'];

    try {
        $tokenizer = Container::createTokenizer();

        if (empty($_POST['name'])) {
            $error = 'no_name';
        } elseif (empty($_POST['address'])) {
            $error = 'no_addr';
        } elseif ($tokenizer->NessAddrExists($__address)) {
            $tokenizer->createToken($__address, $__name, $__value);
            ob_clean();
            header("location: /token.php?token=".$__address);
        } else {
            $error = 'addr_not_exist';
        }
    } catch (\Throwable $th) {
        $msg = $th->getMessage();

        if (false !== strpos($msg, "Couldn't connect to server") || false !== strpos($msg, "Request error") || false !== strpos($msg, "locked")) {
            $error = 'connect_emc';
        } elseif (false !== strpos($msg, "Ness connection error")) {
            $error = 'connect_ness';
        }
    }
} else {
    try {
        $tokenizer = Container::createTokenizer();
        $tokens = $tokenizer->freeTokensLeft();
    } catch (\Throwable $th) {
        $msg = $th->getMessage();

        if (false !== strpos($msg, "Couldn't connect to server") || false !== strpos($msg, "Request error") || false !== strpos($msg, "locked")) {
            $error = 'connect_emc';
        } elseif (false !== strpos($msg, "Ness connection error")) {
            $error = 'connect_ness';
        }
    }
}
?>

<?php require "../templates/create-token.php"; ?>

<?php require "../templates/footer.php"; ?>
