<?php

namespace Users\Bookmarks\Received;

function unarchive ($mysqli, $receivedBookmark) {

    if (!$receivedBookmark->archived) return;

    include_once __DIR__.'/../../../ReceivedBookmarks/setArchived.php';
    \ReceivedBookmarks\setArchived($mysqli, $receivedBookmark->id, false);

    include_once __DIR__.'/addNumbers.php';
    addNumbers($mysqli, $receivedBookmark->receiver_id_users, 0, -1);

}
