<?php

function require_tokens () {

    include_once __DIR__.'/../../../fns/require_user_with_password.php';
    $user = require_user_with_password('../../');

    if (!$user->num_tokens) {
        unset(
            $_SESSION['account/tokens/errors'],
            $_SESSION['account/tokens/messages']
        );
        include_once __DIR__.'/../../../../fns/redirect.php';
        redirect('..');
    }

    return $user;

}
