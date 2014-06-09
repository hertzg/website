<?php

function require_received_tasks ($base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../");

    if (!$user->num_received_tasks) {
        $_SESSION['tasks/messages'] = ['No more received tasks.'];
        unset($_SESSION['tasks/errors']);
        include_once "$fnsDir/redirect.php";
        redirect("$base..");
    }

    return $user;

}
