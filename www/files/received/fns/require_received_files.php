<?php

function require_received_files ($base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../");

    if (!$user->num_received_files && !$user->num_received_folders) {
        $_SESSION['files/messages'] = ['No more received files.'];
        unset($_SESSION['files/errors']);
        include_once "$fnsDir/redirect.php";
        redirect("$base..");
    }

    return $user;

}
