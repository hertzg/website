<?php

include_once '../../../lib/defaults.php';

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_admin.php';
require_admin();

include_once '../../fns/Users/OrderBy/set.php';
$ok = Users\OrderBy\set('storage_used desc');

if ($ok === false) {
    unset($_SESSION['admin/users/messages']);
    $_SESSION['admin/users/errors'] = ['Failed to save the sort field.'];
} else {
    unset($_SESSION['admin/users/errors']);
    $_SESSION['admin/users/messages'] = [
        'The list is now sorted by storage used.',
    ];
}

include_once '../../fns/redirect.php';
include_once '../../fns/ItemList/listUrl.php';
redirect(ItemList\listUrl('./'));
