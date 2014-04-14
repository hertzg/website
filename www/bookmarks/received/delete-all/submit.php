<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_received_bookmarks.php';
$user = require_received_bookmarks('../');
$id_users = $user->id_users;

include_once '../../../fns/ReceivedBookmarks/deleteOnReceiver.php';
include_once '../../../lib/mysqli.php';
ReceivedBookmarks\deleteOnReceiver($mysqli, $id_users);

include_once '../../../fns/Users/clearNumReceivedBookmarks.php';
Users\clearNumReceivedBookmarks($mysqli, $id_users);

unset($_SESSION['bookmarks/errors']);
$_SESSION['bookmarks/messages'] = [
    'All received bookmarks have been deleted.',
];

include_once '../../../fns/redirect.php';
redirect('../..');
