<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
require_user('../../');

include_once '../../fns/Bookmarks/deleteOnUser.php';
include_once '../../lib/mysqli.php';
Bookmarks\deleteOnUser($mysqli, $idusers);

include_once '../../fns/BookmarkTags/deleteOnUser.php';
BookmarkTags\deleteOnUser($mysqli, $idusers);

$_SESSION['bookmarks/index_messages'] = array(
    'All bookmarks have been deleted.',
);

include_once '../../fns/redirect.php';
redirect('..');
