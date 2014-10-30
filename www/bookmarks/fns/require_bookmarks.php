<?php

function require_bookmarks () {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../../');

    if (!$user->num_bookmarks) {
        unset(
            $_SESSION['bookmarks/errors'],
            $_SESSION['bookmarks/messages']
        );
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    return $user;

}
