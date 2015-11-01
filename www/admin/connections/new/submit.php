<?php

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../../fns/require_admin.php';
require_admin();

include_once '../fns/request_connection_params.php';
include_once '../../../lib/mysqli.php';
list($address, $their_exchange_api_key,
    $expires, $expire_time) = request_connection_params($mysqli, $errors);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['admin/connections/new/errors'] = $errors;
    $_SESSION['admin/connections/new/values'] = [
        'address' => $address,
        'their_exchange_api_key' => $their_exchange_api_key,
        'expires' => $expires,
    ];
    redirect();
}

include_once "$fnsDir/AdminConnections/add.php";
$id = AdminConnections\add($mysqli, $address,
    $their_exchange_api_key, $expire_time);

unset(
    $_SESSION['admin/connections/new/errors'],
    $_SESSION['admin/connections/new/values']
);

$_SESSION['admin/connections/view/messages'] = [
    'Connection has been saved.',
];

redirect("../view/?id=$id");
