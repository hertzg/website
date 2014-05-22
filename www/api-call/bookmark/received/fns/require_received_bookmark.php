<?php

function require_received_bookmark ($mysqli, $id_users) {

    include_once __DIR__.'/../../../../fns/request_strings.php';
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once __DIR__.'/../../../../fns/ReceivedBookmarks/getOnReceiver.php';
    $receivedBookmark = ReceivedBookmarks\getOnReceiver(
        $mysqli, $id_users, $id);

    if (!$receivedBookmark) {
        include_once __DIR__.'/../../../fns/bad_request.php';
        bad_request('RECEIVED_BOOKMARK_NOT_FOUND');
    }

    return $receivedBookmark;

}
