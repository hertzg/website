<?php

function require_bar_charts () {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../../');

    if (!$user->num_bar_charts) {
        unset(
            $_SESSION['bar-charts/errors'],
            $_SESSION['bar-charts/messages']
        );
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    return $user;

}
