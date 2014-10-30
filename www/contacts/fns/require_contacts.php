<?php

function require_contacts () {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../../');

    if (!$user->num_contacts) {
        unset(
            $_SESSION['contacts/errors'],
            $_SESSION['contacts/messages']
        );
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    return $user;

}
