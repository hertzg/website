<?php

function require_received_bookmark ($mysqli) {

    include_once __DIR__.'/../../../fns/require_user.php';
    $user = require_user('../../../');

    include_once __DIR__.'/../../../fns/request_strings.php';
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once __DIR__.'/../../../fns/ReceivedBookmarks/getOnReceiver.php';
    $receivedBookmark = ReceivedBookmarks\getOnReceiver($mysqli, $user->id_users, $id);

    if (!$receivedBookmark) {
        include_once __DIR__.'/../../../fns/redirect.php';
        redirect('..');
    }

    return [$receivedBookmark, $id, $user];

}
