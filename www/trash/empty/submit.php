<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');

include_once '../../fns/DeletedItems/deleteOnUser.php';
include_once '../../lib/mysqli.php';
DeletedItems\deleteOnUser($mysqli, $user->id_users);

$_SESSION['trash/messages'] = ['Trash has been emptied.'];

include_once '../../fns/redirect.php';
redirect('..');
