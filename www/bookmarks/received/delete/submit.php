<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('../..');

include_once '../fns/require_received_bookmark.php';
include_once '../../../lib/mysqli.php';
list($receivedBookmark, $id, $user) = require_received_bookmark($mysqli);

include_once '../../../lib/mysqli.php';

include_once '../../../fns/ReceivedBookmarks/delete.php';
ReceivedBookmarks\delete($mysqli, $id);

include_once '../../../fns/Users/addNumReceivedBookmarks.php';
Users\addNumReceivedBookmarks($mysqli, $user->id_users, -1);

$_SESSION['bookmarks/received/messages'] = ['Note has been deleted.'];

include_once '../../../fns/redirect.php';
redirect('..');
