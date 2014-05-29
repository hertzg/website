<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_received_bookmark.php';
include_once '../../../lib/mysqli.php';
list($receivedBookmark, $id, $user) = require_received_bookmark($mysqli);

include_once '../../../fns/Users/Bookmarks/Received/unarchive.php';
Users\Bookmarks\Received\unarchive($mysqli, $receivedBookmark);

$_SESSION['bookmarks/received/view/messages'] = [
    'Bookmark has been unarchived.',
];

include_once '../../../fns/redirect.php';
redirect("./?id=$id");
