<?php

function require_received_notes ($base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../");

    if (!$user->num_received_notes) {
        $_SESSION['notes/messages'] = ['No more received notes.'];
        unset($_SESSION['notes/errors']);
        include_once "$fnsDir/redirect.php";
        redirect("$base..");
    }

    return $user;

}
