<?php

function require_received_bookmark ($mysqli, $base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../");

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Bookmarks/Received/get.php";
    $receivedBookmark = Users\Bookmarks\Received\get($mysqli, $user, $id);

    if (!$receivedBookmark) {
        unset($_SESSION['bookmarks/received/messages']);
        $error = 'The received bookmark no longer exists.';
        $_SESSION['bookmarks/received/errors'] = [$error];
        include_once "$fnsDir/redirect.php";
        redirect($base === '' ? './' : $base);
    }

    return [$receivedBookmark, $id, $user];

}
