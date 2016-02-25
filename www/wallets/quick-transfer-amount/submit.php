<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once 'fns/require_multiple_wallets.php';
$user = require_multiple_wallets();

include_once "$fnsDir/request_strings.php";
list($from_id, $to_id) = request_strings('from_id', 'to_id');

$from_id = abs((int)$from_id);
$to_id = abs((int)$to_id);

include_once "$fnsDir/Users/Wallets/get.php";
include_once '../../lib/mysqli.php';
$fromWallet = Users\Wallets\get($mysqli, $user, $from_id);

$focus = null;
$errors = [];

if (!$fromWallet) {
    $errors[] = 'The "From" wallet no longer exists.';
    $focus = 'from_id';
}

$toWallet = Users\Wallets\get($mysqli, $user, $to_id);

if (!$toWallet) {
    $errors[] = 'The "To" wallet no longer exists.';
    if ($focus === null) $focus = 'to_id';
}

if (!$errors) {
    if ($from_id == $to_id) {
        $errors[] = 'The "From" wallet and the "To" wallet cannot be the same.';
        if ($focus === null) $focus = 'to_id';
    }
}

include_once '../fns/request_transaction_params.php';
list($amount, $parsed_amount,
    $description) = request_transaction_params($errors, $focus);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['wallets/quick-transfer-amount/errors'] = $errors;
    $_SESSION['wallets/quick-transfer-amount/values'] = [
        'focus' => $focus,
        'from_id' => $from_id,
        'to_id' => $to_id,
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

unset($_SESSION['wallets/view/errors']);
$_SESSION['wallets/view/messages'] = ['The amount has been transferred.'];

include_once "$fnsDir/ItemList/itemQuery.php";
redirect('../view/'.ItemList\itemQuery($from_id));
