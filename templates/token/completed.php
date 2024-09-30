<div class="container">
    <div class="row">
        <div class="col">
            <div class="mb-3">
                <h3>Token [ <?=htmlentities($_GET['token'])?> ] is registered in blockchain</h3>

                <h4><?=$token['name']?></h4>

                <blockquote><?=$token['message']?></blockquote>

                <h4>
                    NESS address:
                    <a href="https://ness-explorer.magnetosphere.net/app/address/<?=$token['ness_addr']?>" target=_blank><?=$token['ness_addr']?></a>
                </h4>
                <h4>NESS balance: <?=$token['ness_balance']?> NESS</h4>
                <h4>
                    BTC address:
                    <a href="https://www.blockchain.com/explorer/addresses/btc/<?=$token['btc_addr']?>" target=_blank><?=$token['btc_addr']?></a>
                </h4>
                <h4>BTC balance: <?=$token['btc_balance']?> BTC</h4>

                <h3>
                The token is payed and processed.
                </h3>

                <h3>
                Thank you =)
                </h3>

                <a href="javascript:location.reload()">RELOAD</a>
            </div>
        </div>
    </div>
</div>