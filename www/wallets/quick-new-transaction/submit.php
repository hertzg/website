<?php

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once "$fnsDir/require_user.php";
$user = require_user('../../');

include_once "$fnsDir/request_strings.php";
list($id_wallets) = request_strings('id_wallets');

$id_wallets = abs((int)$id_wallets);

include_once "$fnsDir/Users/Wallets/get.php";
include_once '../../lib/mysqli.php';
$wallet = Users\Wallets\get($mysqli, $user, $id_wallets);

$errors = [];

if (!$wallet) $errors[] = 'The wallet no longer exists.';

include_once '../fns/request_transaction_params.php';
$values = request_transaction_params($errors);
list($amount, $parsed_amount, $description) = $values;

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['wallets/quick-new-transaction/errors'] = $errors;
    $_SESSION['wallets/quick-new-transaction/values'] = [
        'id_wallets' => $id_wallets,
        'amount' => $amount,
        'description' => $description,
    ];
    redirect();
}

unset(
    $_SESSION['wallets/quick-new-transaction/errors'],
    $_SESSION['wallets/quick-new-transaction/values']
);

include_once "$fnsDir/Users/Wallets/Transactions/add.php";
$id = Users\Wallets\Transactions\add($mysqli,
    $wallet, $parsed_amount, $description);

$message = 'The transaction has been saved.';
$_SESSION['wallets/view-transaction/messages'] = [$message];

redirect("../view-transaction/?id=$id");
