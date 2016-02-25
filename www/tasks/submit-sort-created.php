<?php

include_once '../../lib/defaults.php';

include_once '../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_user.php';
$user = require_user('../');

include_once '../fns/Users/Tasks/editOrderBy.php';
include_once '../lib/mysqli.php';
Users\Tasks\editOrderBy($mysqli, $user->id_users, 'insert_time desc');

unset($_SESSION['tasks/errors']);
$_SESSION['tasks/messages'] = ['The list is now sorted by created time.'];

include_once '../fns/redirect.php';
include_once '../fns/ItemList/listUrl.php';
redirect(ItemList\listUrl('./'));
