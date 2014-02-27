<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_bookmark.php';
include_once '../../lib/mysqli.php';
list($bookmark, $id) = require_bookmark($mysqli);

include_once '../../fns/Bookmarks/delete.php';
Bookmarks\delete($mysqli, $id);

include_once '../../fns/BookmarkTags/deleteOnBookmark.php';
BookmarkTags\deleteOnBookmark($mysqli, $id);

include_once '../../fns/Users/addNumBookmarks.php';
Users\addNumBookmarks($mysqli, $idusers, -1);

$_SESSION['bookmarks/index_messages'] = array('Bookmark has been deleted.');

include_once '../../fns/redirect.php';
redirect('..');
