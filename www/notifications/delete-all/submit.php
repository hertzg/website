<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');
$id_users = $user->id_users;

include_once '../../fns/Users/Notifications/deleteAll.php';
include_once '../../lib/mysqli.php';
Users\Notifications\deleteAll($mysqli, $id_users);

unset($_SESSION['notifications/errors']);
$_SESSION['notifications/messages'] = [
    'All notifications have been deleted.',
];

include_once '../../fns/redirect.php';
redirect('..');
