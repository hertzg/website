<?php

include_once '../lib/sameDomainReferer.php';
include_once '../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');
include_once 'lib/require-user.php';

include_once '../classes/Bookmarks.php';
Bookmarks::deleteOnUser($idusers);

include_once '../classes/BookmarkTags.php';
BookmarkTags::deleteOnUser($idusers);

$_SESSION['bookmarks/index_messages'] = array(
    'All bookmarks have been deleted.',
);

redirect();
