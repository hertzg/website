<?php

function require_notifications () {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../../');

    if (!$user->num_notifications) {
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    return $user;

}
