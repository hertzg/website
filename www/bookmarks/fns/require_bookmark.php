<?php

function require_bookmark ($mysqli, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../");

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Bookmarks/getOnUser.php";
    $bookmark = Bookmarks\getOnUser($mysqli, $user->id_users, $id);

    if (!$bookmark) {
        unset($_SESSION['bookmarks/messages']);
        $_SESSION['bookmarks/errors'] = [
            'The bookmark no longer exists.',
        ];
        include_once "$fnsDir/redirect.php";
        redirect("$base..");
    }

    return [$bookmark, $id, $user];

}
