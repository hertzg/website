<?php

include_once '../../lib/defaults.php';

include_once '../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_user.php';
$user = require_user('../');

include_once '../fns/Users/Contacts/editOrderBy.php';
include_once '../lib/mysqli.php';
Users\Contacts\editOrderBy($mysqli,
    $user->id_users, 'full_name, insert_time desc');

unset($_SESSION['contacts/errors']);
$_SESSION['contacts/messages'] = ['The list is now sorted by full name.'];

include_once '../fns/redirect.php';
include_once '../fns/ItemList/listUrl.php';
redirect(ItemList\listUrl('./'));
