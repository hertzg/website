<?php

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_transaction.php';
include_once '../../../lib/mysqli.php';
list($transaction, $id, $user) = require_transaction($mysqli);

include_once "$fnsDir/Users/Wallets/Transactions/delete.php";
Users\Wallets\Transactions\delete($mysqli, $transaction);

$message = 'The transaction has been deleted.';
$_SESSION['wallets/all-transactions/messages'] = [$message];

include_once "$fnsDir/redirect.php";
redirect("../?id=$transaction->id_wallets");
