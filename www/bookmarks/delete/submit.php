<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_bookmark.php';
include_once '../../lib/mysqli.php';
list($bookmark, $id, $user) = require_bookmark($mysqli);

include_once '../../fns/Users/Bookmarks/delete.php';
Users\Bookmarks\delete($mysqli, $bookmark);

unset($_SESSION['bookmarks/errors']);
$_SESSION['bookmarks/messages'] = ['Bookmark has been deleted.'];

include_once '../../fns/redirect.php';
include_once '../../fns/ItemList/listUrl.php';
redirect(ItemList\listUrl());
