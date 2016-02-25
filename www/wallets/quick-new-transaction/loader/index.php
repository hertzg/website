<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/ApiCall/requireClientRevision.php";
ApiCall\requireClientRevision();

include_once "$fnsDir/ApiCall/requireUser.php";
$user = ApiCall\requireUser();

if (!$user->num_wallets) {
    include_once "$fnsDir/ApiCall/Error/badRequest.php";
    ApiCall\Error\badRequest('"ONE_WALLET_REQUIRED"');
}

include_once '../fns/unset_session_vars.php';
unset_session_vars();

include_once "$fnsDir/create_page_load_response.php";
$response = create_page_load_response($user);

include_once '../fns/get_values.php';
$response['values'] = get_values();

include_once "$fnsDir/WalletTransactions/maxLengths.php";
$response['maxLengths'] = WalletTransactions\maxLengths();

include_once "$fnsDir/Wallets/indexOnUser.php";
include_once '../../../lib/mysqli.php';
$wallets = Wallets\indexOnUser($mysqli, $user->id_users);

$response['wallets'] = array_map(function ($wallet) {
    return [
        'id' => $wallet->id,
        'name' => $wallet->name,
        'balance' => $wallet->balance,
    ];
}, $wallets);

$key = 'wallets/quick-new-transaction/errors';
if (array_key_exists($key, $_SESSION)) $response['errors'] = $_SESSION[$key];

$response['itemList'] = [];
include_once "$fnsDir/ItemList/pageParams.php";
foreach (ItemList\pageParams() as $key => $value) {
    $response['itemList'][] = [
        'key' => $key,
        'value' => $value,
    ];
}

header('Content-Type: application/json');
echo json_encode($response);
