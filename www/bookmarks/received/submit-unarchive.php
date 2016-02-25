<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once 'fns/require_received_bookmark.php';
include_once '../../lib/mysqli.php';
list($receivedBookmark, $id, $user) = require_received_bookmark($mysqli);

include_once "$fnsDir/Users/Bookmarks/Received/unarchive.php";
Users\Bookmarks\Received\unarchive($mysqli, $receivedBookmark);

$message = 'Bookmark has been unarchived.';
$_SESSION['bookmarks/received/view/messages'] = [$message];

include_once "$fnsDir/redirect.php";
include_once "$fnsDir/ItemList/Received/itemQuery.php";
redirect('view/'.ItemList\Received\itemQuery($id));
