<?php

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_wallet.php';
include_once '../../lib/mysqli.php';
list($wallet, $id, $user) = require_wallet($mysqli);

include_once "$fnsDir/Users/Wallets/delete.php";
Users\Wallets\delete($mysqli, $wallet);

$_SESSION['wallets/messages'] = ['The wallet has been deleted.'];
unset($_SESSION['wallets/errors']);

include_once "$fnsDir/redirect.php";
redirect('..');
