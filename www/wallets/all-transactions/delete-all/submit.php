<?php

include_once '../../../../lib/defaults.php';

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('../..');

include_once '../fns/require_transactions.php';
include_once '../../../lib/mysqli.php';
list($wallet, $id, $user) = require_transactions($mysqli, '../');

include_once "$fnsDir/Users/Wallets/Transactions/deleteAll.php";
Users\Wallets\Transactions\deleteAll($mysqli, $wallet);

unset($_SESSION['wallets/view/errors']);
$_SESSION['wallets/view/messages'] = ['All transactions have been deleted.'];

include_once "$fnsDir/redirect.php";
redirect("../../view/?id=$id");
