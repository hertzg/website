<?php

include_once '../../../fns/ApiCall/requireClientRevision.php';
ApiCall\requireClientRevision();

include_once '../../../fns/ApiCall/requireUser.php';
$user = ApiCall\requireUser();

include_once '../fns/unset_session_vars.php';
unset_session_vars();

include_once '../../../fns/create_page_load_response.php';
$response = create_page_load_response($user);

include_once '../fns/get_values.php';
$response['values'] = get_values();

include_once '../../../fns/WalletTransactions/maxLengths.php';
$response['maxLengths'] = WalletTransactions\maxLengths();

include_once '../../../fns/Wallets/indexOnUser.php';
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

header('Content-Type: application/json');
echo json_encode($response);
