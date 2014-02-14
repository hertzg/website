<?php

include_once '../../lib/sameDomainReferer.php';
include_once '../../fns/redirect.php';
if (!$sameDomainReferer) redirect('../..');
include_once 'lib/require-user.php';

include_once '../../fns/Bookmarks/deleteOnUser.php';
include_once '../../lib/mysqli.php';
Bookmarks\deleteOnUser($mysqli, $idusers);

include_once '../../fns/BookmarkTags/deleteOnUser.php';
BookmarkTags\deleteOnUser($mysqli, $idusers);

$_SESSION['bookmarks/index_messages'] = array(
    'All bookmarks have been deleted.',
);

redirect('..');
