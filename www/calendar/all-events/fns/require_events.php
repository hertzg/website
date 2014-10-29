<?php

function require_events ($base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../");

    if (!$user->num_events) {
        include_once "$fnsDir/redirect.php";
        redirect("$base..");
    }

    return $user;

}
