<?php

include_once '../../lib/sameDomainReferer.php';
include_once '../../fns/redirect.php';
if (!$sameDomainReferer) redirect('../..');

include_once '../fns/require_bookmark.php';
include_once '../../lib/mysqli.php';
list($bookmark, $id) = require_bookmark($mysqli);

include_once '../../fns/Bookmarks/delete.php';
Bookmarks\delete($mysqli, $id);

include_once '../../fns/BookmarkTags/deleteOnBookmark.php';
BookmarkTags\deleteOnBookmark($mysqli, $id);

$_SESSION['bookmarks/index_messages'] = array('Bookmark has been deleted.');

redirect('..');
