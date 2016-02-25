<?php

include_once '../../lib/defaults.php';

include_once '../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_user.php';
$user = require_user('../');

include_once '../fns/Users/Calculations/editOrderBy.php';
include_once '../lib/mysqli.php';
Users\Calculations\editOrderBy($mysqli,
    $user->id_users, 'title, insert_time desc');

unset($_SESSION['calculations/errors']);
$_SESSION['calculations/messages'] = ['The list is now sorted by title.'];

include_once '../fns/redirect.php';
include_once '../fns/ItemList/listUrl.php';
redirect(ItemList\listUrl('./'));
