<?php

function require_schedules () {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../../');

    if (!$user->num_schedules) {
        unset(
            $_SESSION['schedules/errors'],
            $_SESSION['schedules/messages']
        );
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    return $user;

}
