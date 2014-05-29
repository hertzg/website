<?php

namespace Users\Bookmarks\Received;

function archive ($mysqli, $receivedBookmark) {
    include_once __DIR__.'/../../../ReceivedBookmarks/setArchived.php';
    \ReceivedBookmarks\setArchived($mysqli, $receivedBookmark->id, true);
}
