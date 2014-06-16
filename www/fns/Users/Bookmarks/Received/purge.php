<?php

namespace Users\Bookmarks\Received;

function purge ($mysqli, $receivedBookmark) {

    include_once __DIR__.'/../../../ReceivedBookmarks/delete.php';
    \ReceivedBookmarks\delete($mysqli, $receivedBookmark->id);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $receivedBookmark->receiver_id_users, -1);

}
