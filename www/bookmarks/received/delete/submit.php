<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('../..');

include_once '../fns/require_received_bookmark.php';
include_once '../../../lib/mysqli.php';
list($receivedBookmark, $id, $user) = require_received_bookmark($mysqli, '../');

include_once "$fnsDir/Users/Bookmarks/Received/delete.php";
Users\Bookmarks\Received\delete($mysqli, $receivedBookmark);

$messages = ["Received bookmark #$id has been deleted."];
include_once "$fnsDir/redirect.php";

if ($user->num_received_bookmarks == 1) {
    $messages[] = 'No more received bookmarks.';
    $_SESSION['bookmarks/messages'] = $messages;
    unset($_SESSION['bookmarks/errors']);
    redirect('../..');
}

unset($_SESSION['bookmarks/received/errors']);
$_SESSION['bookmarks/received/messages'] = $messages;

include_once "$fnsDir/ItemList/Received/listUrl.php";
redirect(ItemList\Received\listUrl('../'));
