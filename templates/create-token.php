<div class="container">
        <div class="row">
            <div class="col">
                <span class="head">Create Exchange Token</span>
                <p class="token-stored">This Token will be stored in blockchain forever !</p>
               <p class="token-stored">After creation, the BTC address will be generated, all funds sent to this address will be exchanged 1 to 1000000.
                </p>
                <p class="token-left">There are <?=$tokens?> Tokens left</p>

                <form method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label <?php if ('no_name' === $error): ?>error<?php endif ?>">
                            Name:
                        </label><br>

                        <input type="text" class="form-control" id="name" name="name" value="<?= htmlentities($__name) ?>" placeholder="Your name here" required>


                        <div id="nameHelp" class="form-text <?php if ('no_name' === $error): ?>error<?php endif ?>">
                            Your name or Nickname
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label <?php if ('no_addr' === $error || 'addr_not_exist' === $error): ?>error<?php endif ?>">
                            NESS address:
                        </label><br>

                        <input type="text" class="form-control" id="address" name="address" value="<?= htmlentities($__address) ?>" placeholder="" required>


                        <div id="addressHelp" class="form-text <?php if ('no_addr' === $error || 'addr_not_exist' === $error): ?>error<?php endif ?>">
                            PrivateNess address to receive NESS<br/>
                            It must be an empty address from your PrivateNess wallet
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="value" class="form-label">
                            Message:
                        </label><br>

                        <textarea name="value" id="value" class="form-control" cols="25" rows="6" placeholder="Hello world" required><?= htmlentities($__value) ?></textarea>


                        <div id="valueHelp" class="form-text">
                            Your message to other Investors</div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Create exchange token
                    </button>
                </form> <br>

                <?php if ('no_name' === $error) : ?>

                    <div class="alert alert-danger" role="alert">
                        Name empty
                    </div>

                <?php elseif ('no_addr' === $error) : ?>

                    <div class="alert alert-danger" role="alert">
                        NESS address empty
                    </div>

                <?php elseif ('addr_not_exist' === $error) : ?>

                    <div class="alert alert-danger" role="alert">
                        NESS address "<?=htmlentities($__address)?>" does not exist
                    </div>

                <?php elseif ('connect_ness' === $error) : ?>

                    <div class="alert alert-danger" role="alert">
                        Internal error</br>
                        Error connecting to PrivateNesss Network
                    </div>

                <?php elseif ('connect_emc' === $error) : ?>

                    <div class="alert alert-danger" role="alert">
                        Internal error</br>
                        Error connecting to Emercoin network
                    </div>

                <?php endif; ?>

            </div>
        </div>
    </div>
