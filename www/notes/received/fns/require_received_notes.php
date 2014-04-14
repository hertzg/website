<?php

function require_received_notes ($base = '') {

    include_once __DIR__.'/../../../fns/require_user.php';
    $user = require_user("$base../../");

    if (!$user->num_received_notes) {
        $_SESSION['notes/messages'] = ['No more received notes.'];
        unset($_SESSION['notes/errors']);
        include_once __DIR__.'/../../../fns/redirect.php';
        redirect("$base..");
    }

    return $user;

}
