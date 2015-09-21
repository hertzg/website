<?php

include_once '../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_user.php';
$user = require_user('../');

include_once '../fns/Users/Bookmarks/editOrderBy.php';
include_once '../lib/mysqli.php';
Users\Bookmarks\editOrderBy($mysqli, $user->id_users, 'update_time desc');

unset($_SESSION['bookmarks/errors']);
$_SESSION['bookmarks/messages'] = [
    'The list is now sorted by last modified time.',
];

include_once '../fns/redirect.php';
include_once '../fns/ItemList/listUrl.php';
redirect(ItemList\listUrl('./'));
