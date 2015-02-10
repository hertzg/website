<?php

function require_received_places ($base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../");

    if (!$user->num_received_places) {
        $_SESSION['places/messages'] = ['No more received places.'];
        unset($_SESSION['places/errors']);
        include_once "$fnsDir/redirect.php";
        redirect("$base..");
    }

    return $user;

}
