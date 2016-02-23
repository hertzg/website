<?php

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_connection.php';
include_once '../../../lib/mysqli.php';
list($connection, $id) = require_connection($mysqli, '../');

include_once '../fns/request_connection_params.php';
list($address, $their_exchange_api_key, $expires,
    $expire_time) = request_connection_params($mysqli, $errors, $focus, $id);

include_once "$fnsDir/request_strings.php";
list($randomizeKey) = request_strings('randomizeKey');

$randomizeKey = (bool)$randomizeKey;

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['admin/connections/edit/errors'] = $errors;
    $_SESSION['admin/connections/edit/values'] = [
        'focus' => $focus,
        'address' => $address,
        'their_exchange_api_key' => $their_exchange_api_key,
        'expires' => $expires,
        'randomizeKey' => $randomizeKey,
    ];
    redirect("./$itemQuery");
}

include_once "$fnsDir/AdminConnections/edit.php";
AdminConnections\edit($mysqli, $id, $address,
    $their_exchange_api_key, $expire_time);

if ($randomizeKey) {
    include_once "$fnsDir/AdminConnections/randomizeOurExchangeApiKey.php";
    AdminConnections\randomizeOurExchangeApiKey($mysqli, $id);
}

unset(
    $_SESSION['admin/connections/edit/errors'],
    $_SESSION['admin/connections/edit/values']
);

unset($_SESSION['admin/connections/view/errors']);
$_SESSION['admin/connections/view/messages'] = [
    'Changes have been saved.',
    'Consider testing the settings.',
];

redirect("../view/$itemQuery");
