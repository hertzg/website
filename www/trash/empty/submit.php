<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');

include_once '../../fns/Users/DeletedItems/purgeOnUser.php';
include_once '../../lib/mysqli.php';
Users\DeletedItems\purgeOnUser($mysqli, $user->id_users);

unset($_SESSION['trash/errors']);
$_SESSION['trash/messages'] = ['Trash has been emptied.'];

include_once '../../fns/redirect.php';
redirect('..');
