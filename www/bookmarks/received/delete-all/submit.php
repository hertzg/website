<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once '../fns/require_received_bookmarks.php';
$user = require_received_bookmarks('../');

include_once "$fnsDir/Users/Bookmarks/Received/deleteAll.php";
include_once '../../../lib/mysqli.php';
Users\Bookmarks\Received\deleteAll($mysqli, $user);

unset($_SESSION['bookmarks/errors']);
$_SESSION['bookmarks/messages'] = ['All received bookmarks have been deleted.'];

include_once "$fnsDir/redirect.php";
redirect('../..');
