<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../');

include_once '../../fns/Users/ApiKeys/editOrderBy.php';
include_once '../../lib/mysqli.php';
Users\ApiKeys\editOrderBy($mysqli, $user->id_users, 'name');

unset($_SESSION['account/api-keys/errors']);
$_SESSION['account/api-keys/messages'] = ['The list is now sorted by name.'];

include_once '../../fns/redirect.php';
include_once '../../fns/ItemList/listUrl.php';
redirect(ItemList\listUrl('./'));
