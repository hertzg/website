<?php

namespace Users\Bookmarks\Received;

function unarchive ($mysqli, $receivedBookmark) {
    include_once __DIR__.'/../../../ReceivedBookmarks/setArchived.php';
    \ReceivedBookmarks\setArchived($mysqli, $receivedBookmark->id, false);
}
