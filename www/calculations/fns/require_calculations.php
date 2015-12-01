<?php

function require_calculations () {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../../');

    if (!$user->num_calculations) {
        unset(
            $_SESSION['calculations/errors'],
            $_SESSION['calculations/messages']
        );
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    return $user;

}
