<?php

function require_one_channel () {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../../');

    if (!$user->num_channels) {
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    return $user;

}
