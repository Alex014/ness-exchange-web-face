<?php $__donations = true; ?>
<?php require "../templates/header.php"; ?>

<?php 
require "../lib/Container.php";
use lib\Container;

$tokenizer = Container::createTokenizer();

// $tokens = $tokenizer->listPayedTokens();
$tokens = $tokenizer->listRandomTokens();
$ness_summ = 0;

foreach ($tokens as $token) {
    $ness_summ += $token['ness_balance'];
}

$btc_summ = $ness_summ / 1000000;

usort($tokens, function ($token1, $token2) {
    if ($token1['ness_balance'] == $token2['ness_balance']) return 0;
    return ($token1['ness_balance'] > $token2['ness_balance']) ? -1 : 1;
});

?>

<div class="container">
        <div class="row">
            <div class="col">
                <h1>Investments</h1>
                <h1>PR and development budget 10 BTC</h1>

                <div class="progress">
                <div class="progress-bar bg-info" role="progressbar" aria-valuenow="<?=round($btc_summ*100/10)?>"
                aria-valuemin="0" aria-valuemax="100"
                    style="width: <?=round($btc_summ*100/10)?>%;"><?=sprintf('%f',$btc_summ)?> BTC</div>
                </div>

                <h1>Investors</h1>

<?php foreach ($tokens as $token): ?>

                <figure class="text-end">
                <blockquote class="blockquote">
                    <p><?=$token['message']?></p>
                </blockquote>
                <figcaption class="blockquote-footer">
                <?=$token['name']?> <cite><?=sprintf('%f',$token['btc_balance'])?> BTC</cite>
                </figcaption>
                </figure>

<?php endforeach; ?>

            </div>
        </div>
</div>


<?php require "../templates/footer.php"; ?>