<?php

function require_received_bookmark ($mysqli, $user) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Bookmarks/Received/get.php";
    $receivedBookmark = Users\Bookmarks\Received\get($mysqli, $user, $id);

    if (!$receivedBookmark) {
        include_once __DIR__.'/../../../fns/bad_request.php';
        bad_request('RECEIVED_BOOKMARK_NOT_FOUND');
    }

    return $receivedBookmark;

}
