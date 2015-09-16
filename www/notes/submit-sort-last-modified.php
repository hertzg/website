<?php

include_once '../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_user.php';
$user = require_user('../');

include_once '../fns/Users/Notes/editOrderBy.php';
include_once '../lib/mysqli.php';
Users\Notes\editOrderBy($mysqli, $user->id_users, 'update_time desc');

include_once '../fns/redirect.php';
include_once '../fns/ItemList/listUrl.php';
redirect(ItemList\listUrl('./'));
