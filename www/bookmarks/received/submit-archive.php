<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once 'fns/require_received_bookmark.php';
include_once '../../lib/mysqli.php';
list($receivedBookmark, $id, $user) = require_received_bookmark($mysqli);

include_once '../../fns/Users/Bookmarks/Received/archive.php';
Users\Bookmarks\Received\archive($mysqli, $receivedBookmark);

$_SESSION['bookmarks/received/view/messages'] = ['Bookmark has been archived.'];

include_once '../../fns/redirect.php';
redirect("view/?id=$id");
