<?php

include_once '../../../lib/defaults.php';

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_admin.php';
require_admin();

include_once '../../fns/AdminApiKeys/OrderBy/set.php';
$ok = AdminApiKeys\OrderBy\set('name');

if ($ok === false) {
    unset($_SESSION['admin/api-keys/messages']);
    $_SESSION['admin/api-keys/errors'] = ['Failed to save the sort field.'];
} else {
    unset($_SESSION['admin/api-keys/errors']);
    $_SESSION['admin/api-keys/messages'] = [
        'The list is now sorted by name.',
    ];
}

include_once '../../fns/redirect.php';
include_once '../../fns/ItemList/listUrl.php';
redirect(ItemList\listUrl('./'));
