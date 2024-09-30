<?php $__token = true; ?>
<?php require "../templates/header.php"; ?>

<?php 
require "../lib/Container.php";
use lib\Container;

if ( empty($_GET['token']) ) {
    require "../templates/token/find.php"; 
} else {
    $tokenizer = Container::createTokenizer();
    $ness_addr = (string) $_GET['token'];
    $token = $tokenizer->findToken($ness_addr);

    if ('not_found' === $token['status']) {
        require "../templates/token/not_found.php"; 
    } elseif  ('found' === $token['status']) {
        require "../templates/token/found.php"; 
    } elseif ('created' === $token['status']) {
        require "../templates/token/created.php"; 
    } elseif ('payed' === $token['status']) {
        require "../templates/token/payed.php"; 
    } elseif ('completed' === $token['status']) {
        require "../templates/token/completed.php"; 
    }
}


?>


<?php require "../templates/footer.php"; ?>