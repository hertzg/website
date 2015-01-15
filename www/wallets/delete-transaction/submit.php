<?php

include_once '../fns/require_transaction.php';
include_once '../../lib/mysqli.php';
list($transaction, $id, $user) = require_transaction($mysqli);

$fnsDir = '../../fns';

include_once "$fnsDir/Users/Wallets/Transactions/delete.php";
Users\Wallets\Transactions\delete($mysqli, $transaction);

$_SESSION['wallets/view/messages'] = ['The transaction has been deleted.'];

include_once "$fnsDir/redirect.php";
redirect("../view/?id=$transaction->id_wallets");
