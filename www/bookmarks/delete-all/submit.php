<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');

include_once '../../fns/Users/Bookmarks/deleteAll.php';
include_once '../../lib/mysqli.php';
Users\Bookmarks\deleteAll($mysqli, $user->id_users);

unset($_SESSION['bookmarks/errors']);
$_SESSION['bookmarks/messages'] = [
    'All bookmarks have been deleted.',
];

include_once '../../fns/redirect.php';
redirect('..');
