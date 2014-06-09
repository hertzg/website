<?php

function require_received_bookmarks ($base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../");

    if (!$user->num_received_bookmarks) {
        $_SESSION['bookmarks/messages'] = ['No more received bookmarks.'];
        unset($_SESSION['bookmarks/errors']);
        include_once "$fnsDir/redirect.php";
        redirect("$base..");
    }

    return $user;

}
