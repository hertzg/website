<?php

function require_received_tasks ($base = '') {

    include_once __DIR__.'/../../../fns/require_user.php';
    $user = require_user("$base../../");

    if (!$user->num_received_tasks) {
        $_SESSION['tasks/messages'] = ['No more received tasks.'];
        unset($_SESSION['tasks/errors']);
        include_once __DIR__.'/../../../fns/redirect.php';
        redirect("$base..");
    }

    return $user;

}
