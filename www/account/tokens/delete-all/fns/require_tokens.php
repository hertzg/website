<?php

function require_tokens () {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../../../');

    if (!$user->num_tokens) {
        unset(
            $_SESSION['account/tokens/errors'],
            $_SESSION['account/tokens/messages']
        );
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    return $user;

}
