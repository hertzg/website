<?php

function require_notifications () {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../../');

    if (!$user->num_notifications) {
        unset(
            $_SESSION['notifications/errors'],
            $_SESSION['notifications/messages']
        );
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    return $user;

}
