<?php

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_wallet.php';
include_once '../../lib/mysqli.php';
list($wallet, $id, $user) = require_wallet($mysqli);

include_once '../fns/request_wallet_params.php';
$name = request_wallet_params($errors);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['wallets/edit/errors'] = $errors;
    $_SESSION['wallets/edit/values'] = ['name' => $name];
    redirect("./?id=$id");
}

unset(
    $_SESSION['wallets/edit/errors'],
    $_SESSION['wallets/edit/values']
);

include_once "$fnsDir/Users/Wallets/edit.php";
Users\Wallets\edit($mysqli, $id, $name);

$_SESSION['wallets/view/messages'] = ['Changes have been saved.'];
redirect("../view/?id=$id");
