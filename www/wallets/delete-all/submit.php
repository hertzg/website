<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once '../fns/require_wallets.php';
$user = require_wallets();

include_once "$fnsDir/Users/Wallets/deleteAll.php";
include_once '../../lib/mysqli.php';
Users\Wallets\deleteAll($mysqli, $user);

unset($_SESSION['wallets/errors']);
$_SESSION['wallets/messages'] = ['All wallets have been deleted.'];

include_once "$fnsDir/redirect.php";
redirect('..');
