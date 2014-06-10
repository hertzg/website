<?php

function require_note ($mysqli, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../");

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Notes/getOnUser.php";
    $note = Notes\getOnUser($mysqli, $user->id_users, $id);

    if (!$note) {
        unset($_SESSION['notes/messages']);
        $_SESSION['notes/errors'] = ['The note no longer exists.'];
        include_once "$fnsDir/redirect.php";
        redirect("$base..");
    }

    return [$note, $id, $user];

}
