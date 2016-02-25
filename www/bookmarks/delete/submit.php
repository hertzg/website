<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_bookmark.php';
include_once '../../lib/mysqli.php';
list($bookmark, $id, $user) = require_bookmark($mysqli);

include_once "$fnsDir/Users/Bookmarks/delete.php";
Users\Bookmarks\delete($mysqli, $bookmark);

unset($_SESSION['bookmarks/errors']);
$_SESSION['bookmarks/messages'] = ["Bookmark #$id has been deleted."];

include_once "$fnsDir/redirect.php";
include_once "$fnsDir/ItemList/listUrl.php";
redirect(ItemList\listUrl());
