<div class="container">
        <div class="row">
            <div class="col">
                <h1>Find token</h1>

                <form method="GET">

                <div class="mb-3">
                    <label for="name" class="form-label <?php if ('no_addr' === $error || 'addr_not_exist' === $error): ?>error<?php endif ?>">
                        Ness address:
                    </label><br>

                    <input type="text" class="form-control" id="token" name="token" placeholder="" required>


                    <div id="addressHelp" class="form-text <?php if ('no_addr' === $error || 'addr_not_exist' === $error): ?>error<?php endif ?>">
                        Find token by NESS address
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Find
                    </button>
                </div>
                </form>
            </div>
        </div>
</div>
