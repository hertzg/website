<?php

function require_received_bookmarks ($base = '') {

    include_once __DIR__.'/../../../fns/require_user.php';
    $user = require_user("$base../../");

    if (!$user->num_received_bookmarks) {
        $_SESSION['bookmarks/messages'] = ['No more received bookmarks.'];
        unset($_SESSION['bookmarks/errors']);
        include_once __DIR__.'/../../../fns/redirect.php';
        redirect("$base..");
    }

    return $user;

}
