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
                    BTC address: <a href="https://www.blockchain.com/explorer/addresses/btc/<?=$token['btc_addr']?>" target=_blank><?=$token['btc_addr']?></a>
                </h4>

                <div class="input-group">
                    <input type="text" readonly class="form-control" value="<?=$token['btc_addr']?>" id="btc_addr"  style="margin: 0px;"/>
                    <span class="input-group-text" onclick="copy('#btc_addr','#copy_button')" id="copy_button">Copy</span>
                </div>
                <h4>BTC balance: <?=$token['btc_balance']?> BTC</h4>

                <blockquote>
                All funds sent to this BTC address will be exchanged (1000000 NESS to 1 BTC).
                </blockquote>

                <a href="javascript:location.reload()">RELOAD</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" crossorigin="anonymous">      </script>
    <script>
        function copy(id_input, target) {
            setTimeout(function() {
                $('#copied_tip').remove();
            }, 800);
            $(target).append("<div class='tip' id='copied_tip'>Copied!</div>");
            var input = $(id_input)[0];
            input.select();
            var result = document.execCommand('copy');
            return result;
        }
    </script>