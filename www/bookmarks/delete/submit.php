<?php

include_once '../../lib/sameDomainReferer.php';
include_once '../../fns/redirect.php';
if (!$sameDomainReferer) redirect('../..');
include_once 'lib/require-bookmark.php';

include_once '../../fns/Bookmarks/delete.php';
include_once '../../lib/mysqli.php';
Bookmarks\delete($mysqli, $id);

include_once '../../fns/BookmarkTags/deleteOnBookmark.php';
BookmarkTags\deleteOnBookmark($mysqli, $id);

$_SESSION['bookmarks/index_messages'] = array('Bookmark has been deleted.');

redirect('..');
