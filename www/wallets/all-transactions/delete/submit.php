<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../../fns/require_transaction.php';
include_once '../../../lib/mysqli.php';
list($transaction, $id, $user) = require_transaction($mysqli, '../');

include_once "$fnsDir/Users/Wallets/Transactions/delete.php";
Users\Wallets\Transactions\delete($mysqli, $transaction);

$id_wallets = $transaction->id_wallets;

include_once "$fnsDir/Wallets/getOnUser.php";
$wallet = Wallets\getOnUser($mysqli, $user->id_users, $id_wallets);

include_once "$fnsDir/redirect.php";

$messages = ["Transaction #$id has been deleted."];
if ($wallet->num_transactions) {
    $_SESSION['wallets/all-transactions/messages'] = $messages;
    include_once "$fnsDir/ItemList/itemQuery.php";
    redirect('../'.ItemList\itemQuery($transaction->id_wallets));
}

$messages[] = 'No more transactions.';
$_SESSION['wallets/view/messages'] = $messages;
redirect("../../view/?id=$id_wallets");
