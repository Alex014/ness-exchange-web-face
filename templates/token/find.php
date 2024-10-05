<div class="container">
        <div class="row">
            <div class="col">
                <h1 class="find-token-header">Find Token</h1>

                <form method="GET">

                <div class="mb-3">
                    <label for="name" class="form-label <?php if ('no_addr' === $error || 'addr_not_exist' === $error): ?>error<?php endif ?>">
                        NESS address:
                    </label><br>

                    <input type="text" class="form-control" id="token" name="token" placeholder="" required>


                    <div id="addressHelp" class="form-text <?php if ('no_addr' === $error || 'addr_not_exist' === $error): ?>error<?php endif ?>">
                        Find Token by NESS address
                    </div>

                    <button type="submit" class="btn btn-primary find-btn">
                        Find
                    </button>
                </div>
                </form>
            </div>
        </div>
</div>
