<div class="container">
    <div class="row">
        <div class="col">
            <div class="mb-3">
                <h3 clas="token-registration">Token [ <?=htmlentities($_GET['token'])?> ] is registered in blockchain</h3>

                <h4 class="token-name"><?=$token['name']?></h4>

                <blockquote class="blockquote"><?=$token['message']?></blockquote>

                <h4 class="ness-address-explorer">
                    NESS address:
                    <a href="https://ness-explorer.magnetosphere.net/app/address/<?=$token['ness_addr']?>" target=_blank><?=$token['ness_addr']?></a>
                </h4>
                <h4 class="ness-balance">NESS balance: <?=$token['ness_balance']?> NESS</h4>
                <h4 class="btc-address">
                    BTC address:
                    <a href="https://www.blockchain.com/explorer/addresses/btc/<?=$token['btc_addr']?>" target=_blank><?=$token['btc_addr']?></a>
                </h4>
                <h4 class="btc-balance">BTC balance: <?=$token['btc_balance']?> BTC</h4>

                <h3 class="token-payement-process">
                The token has been payed and processed.
                </h3>

                <h3 class="thanks">
                Thank you =)
                </h3>

                <a href="javascript:location.reload()">RELOAD</a>
            </div>
        </div>
    </div>
</div>
