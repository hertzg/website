<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once 'fns/require_one_wallet.php';
$user = require_one_wallet();

include_once "$fnsDir/request_strings.php";
list($id_wallets) = request_strings('id_wallets');

$id_wallets = abs((int)$id_wallets);

include_once "$fnsDir/Users/Wallets/get.php";
include_once '../../lib/mysqli.php';
$wallet = Users\Wallets\get($mysqli, $user, $id_wallets);

$errors = [];

if (!$wallet) {
    $errors[] = 'The wallet no longer exists.';
    $focus = 'id_wallets';
}

include_once '../fns/request_transaction_params.php';
list($amount, $parsed_amount,
    $description) = request_transaction_params($errors, $focus);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['wallets/quick-new-transaction/errors'] = $errors;
    $_SESSION['wallets/quick-new-transaction/values'] = [
        'focus' => $focus,
        'id_wallets' => $id_wallets,
        'amount' => $amount,
        'description' => $description,
    ];
    include_once "$fnsDir/ItemList/pageQuery.php";
    redirect('./'.ItemList\pageQuery());
}

unset(
    $_SESSION['wallets/quick-new-transaction/errors'],
    $_SESSION['wallets/quick-new-transaction/values']
);

include_once "$fnsDir/Users/Wallets/Transactions/add.php";
$id = Users\Wallets\Transactions\add($mysqli,
    $wallet, $parsed_amount, $description);

$_SESSION['wallets/view-transaction/messages'] = [
    'Transaction has been saved.',
];

include_once "$fnsDir/ItemList/itemQuery.php";
redirect('../view-transaction/'.ItemList\itemQuery($id));
