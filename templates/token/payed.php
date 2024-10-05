<div class="container">
    <div class="row">
        <div class="col">
            <div class="mb-3">
                <h3>Token [<span class="token-registered"><?=htmlentities($_GET['token'])?></span> ] is registered in blockchain</h3>

                <h4><?=$token['name']?></h4>

                <blockquote><?=$token['message']?></blockquote>

                <h4>
                    NESS address:
                    <a href="https://ness-explorer.magnetosphere.net/app/address/<?=$token['ness_addr']?>" target=_blank class="ness-payed-address"><?=$token['ness_addr']?></a>
                </h4>
                <h4>NESS balance: <?=$token['ness_balance']?> (waiting for <?=$token['btc_balance']*1000000?> NESS)</h4>
                <h4>
                    BTC address:
                    <a href="https://www.blockchain.com/explorer/addresses/btc/<?=$token['btc_addr']?>" target=_blank class="btc-payed-address"><?=$token['btc_addr']?></a>
                </h4>
                <h4>BTC balance: <?=$token['btc_balance']?> BTC</h4>

                <blockquote>
                The token is payed by you.
                In 15 minutes  your Token will be processed and you will recieve 1000000 NESS to 1 BTC.
                </blockquote>

                <a href="javascript:location.reload()">RELOAD</a>
            </div>
        </div>
    </div>
</div>