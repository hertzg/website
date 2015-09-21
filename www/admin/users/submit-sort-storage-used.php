<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_admin.php';
require_admin();

include_once '../../fns/Users/OrderBy/set.php';
Users\OrderBy\set('storage_used desc');

unset($_SESSION['admin/users/errors']);
$_SESSION['admin/users/messages'] = [
    'The list is now sorted by storage used.',
];

include_once '../../fns/redirect.php';
include_once '../../fns/ItemList/listUrl.php';
redirect(ItemList\listUrl('./'));