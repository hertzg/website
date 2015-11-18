<?php

function require_received_schedules ($base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../");

    if (!$user->num_received_schedules) {
        $_SESSION['schedules/messages'] = ['No more received schedules.'];
        unset($_SESSION['schedules/errors']);
        include_once "$fnsDir/redirect.php";
        redirect("$base..");
    }

    return $user;

}
