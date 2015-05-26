<?php

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once "$fnsDir/require_user.php";
$user = require_user('../../');

include_once "$fnsDir/request_strings.php";
list($from_id_wallets, $to_id_wallets) = request_strings(
    'from_id_wallets', 'to_id_wallets');

$from_id_wallets = abs((int)$from_id_wallets);
$to_id_wallets = abs((int)$to_id_wallets);

include_once "$fnsDir/Users/Wallets/get.php";
include_once '../../lib/mysqli.php';
$fromWallet = Users\Wallets\get($mysqli, $user, $from_id_wallets);

$errors = [];

if (!$fromWallet) $errors[] = 'The "From" wallet no longer exists.';

$toWallet = Users\Wallets\get($mysqli, $user, $to_id_wallets);

if (!$toWallet) $errors[] = 'The "To" wallet no longer exists.';

if (!$errors) {
    if ($from_id_wallets == $to_id_wallets) {
        $errors[] = 'The "From" wallet and the "To" wallet cannot be the same.';
    }
}

include_once '../fns/request_transaction_params.php';
list($amount, $parsed_amount,
    $description) = request_transaction_params($errors);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['wallets/quick-transfer-amount/errors'] = $errors;
    $_SESSION['wallets/quick-transfer-amount/values'] = [
        'from_id_wallets' => $from_id_wallets,
        'to_id_wallets' => $to_id_wallets,
        'amount' => $amount,
        'description' => $description,
    ];
    include_once "$fnsDir/ItemList/pageQuery.php";
    redirect('./'.ItemList\pageQuery());
}

unset(
    $_SESSION['wallets/quick-transfer-amount/errors'],
    $_SESSION['wallets/quick-transfer-amount/values']
);

include_once "$fnsDir/Users/Wallets/transferAmount.php";
Users\Wallets\transferAmount($mysqli,
    $fromWallet, $toWallet, $parsed_amount, $description);

$_SESSION['wallets/view/messages'] = ['The amount has been transferred.'];

include_once "$fnsDir/ItemList/itemQuery.php";
redirect('../view/'.ItemList\itemQuery($from_id_wallets));
