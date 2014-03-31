<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');
$id_users = $user->id_users;

include_once '../../fns/Bookmarks/deleteOnUser.php';
include_once '../../lib/mysqli.php';
Bookmarks\deleteOnUser($mysqli, $id_users);

include_once '../../fns/BookmarkTags/deleteOnUser.php';
BookmarkTags\deleteOnUser($mysqli, $id_users);

include_once '../../fns/Users/clearNumBookmarks.php';
Users\clearNumBookmarks($mysqli, $id_users);

unset($_SESSION['bookmarks/errors']);
$_SESSION['bookmarks/messages'] = [
    'All bookmarks have been deleted.',
];

include_once '../../fns/redirect.php';
redirect('..');
