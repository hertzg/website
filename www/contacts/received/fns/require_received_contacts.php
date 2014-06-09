<?php

function require_received_contacts ($base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../");

    if (!$user->num_received_contacts) {
        $_SESSION['contacts/messages'] = ['No more received contacts.'];
        unset($_SESSION['contacts/errors']);
        include_once "$fnsDir/redirect.php";
        redirect("$base..");
    }

    return $user;

}
