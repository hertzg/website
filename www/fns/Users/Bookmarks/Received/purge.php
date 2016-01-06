<?php

namespace Users\Bookmarks\Received;

function purge ($mysqli, $receivedBookmark) {

    include_once __DIR__.'/../../../ReceivedBookmarks/delete.php';
    \ReceivedBookmarks\delete($mysqli, $receivedBookmark->id);

    $id_users = $receivedBookmark->receiver_id_users;

    include_once __DIR__.'/addNumbers.php';
    addNumbers($mysqli, $id_users, -1, $receivedBookmark->archived ? -1 : 0);

}
