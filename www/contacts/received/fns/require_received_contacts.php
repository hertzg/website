<?php

function require_received_contacts ($base = '') {

    include_once __DIR__.'/../../../fns/require_user.php';
    $user = require_user("$base../../");

    if (!$user->num_received_contacts) {
        $_SESSION['contacts/messages'] = ['No more received contacts.'];
        unset($_SESSION['contacts/errors']);
        include_once __DIR__.'/../../../fns/redirect.php';
        redirect("$base..");
    }

    return $user;

}
