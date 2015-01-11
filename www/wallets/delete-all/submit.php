<?php

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once "$fnsDir/require_user.php";
$user = require_user('../../');

include_once "$fnsDir/Users/Wallets/deleteAll.php";
include_once '../../lib/mysqli.php';
Users\Wallets\deleteAll($mysqli, $user->id_users);

unset($_SESSION['wallets/errors']);
$_SESSION['wallets/messages'] = ['All wallets have been deleted.'];

include_once "$fnsDir/redirect.php";
redirect('../');
