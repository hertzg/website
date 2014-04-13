<?php

include_once '../../../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../../../fns/require_user.php';
$user = require_user('../../../');

include_once '../../../../fns/Users/restoreOrderHomeItems.php';
include_once '../../../../lib/mysqli.php';
Users\restoreOrderHomeItems($mysqli, $user->id_users);

$_SESSION['home/customize/reorder/messages'] = [
    'Default order has been restored.'
];

include_once '../../../../fns/redirect.php';
redirect('..');
