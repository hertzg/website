<?php

function require_received_files ($base = '') {

    include_once __DIR__.'/../../../fns/require_user.php';
    $user = require_user("$base../../");

    if (!$user->num_received_files) {
        $_SESSION['files/messages'] = ['No more received files.'];
        unset($_SESSION['files/errors']);
        include_once __DIR__.'/../../../fns/redirect.php';
        redirect("$base..");
    }

    return $user;

}
