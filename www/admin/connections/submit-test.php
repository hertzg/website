<?php

include_once '../../../lib/defaults.php';

include_once 'fns/require_connection.php';
include_once '../../lib/mysqli.php';
list($connection, $id, $admin_user) = require_connection($mysqli);

$fnsDir = '../../fns';

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_URL => "{$connection->address}exchange-api-call/doNothing",
    CURLOPT_POSTFIELDS => [
        'exchange_api_key' => $connection->their_exchange_api_key,
    ],
]);
$response = curl_exec($ch);

$errors = [];
if ($response === false) {
    $errors[] = 'Failed to connect to the server.';
    $errors[] = htmlspecialchars(curl_error($ch));
} else {
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $response = json_decode($response);
    if ($status === 200) {
        $messages = ['The connection works.'];
    } else {
        if ($status === 403) {
            if ($response === 'INVALID_EXCHANGE_API_KEY') {
                $errors[] = 'Their key is no longer valid.';
            } else if ($response === 'EXCHANGE_API_KEY_EXPIRED') {
                $errors[] = 'Their key has expired.';
            } else {
                $errors[] = 'Failed to communicate to the server.';
                $errors[] = "Expected HTTP status 200 but received $status.";
            }
        } elseif ($status === 404) {
            $errors[] = 'There is no exchange API at the address.';
        } else {
            $errors[] = 'Failed to communicate to the server.';
            $errors[] = "Expected HTTP status 200 but received $status.";
        }
    }
}

if ($errors) {
    unset($_SESSION['admin/connections/view/messages']);
    $_SESSION['admin/connections/view/errors'] = $errors;
} else {
    unset($_SESSION['admin/connections/view/errors']);
    $_SESSION['admin/connections/view/messages'] = $messages;
}

include_once "$fnsDir/redirect.php";
include_once "$fnsDir/ItemList/itemQuery.php";
redirect('view/'.ItemList\itemQuery($id));
