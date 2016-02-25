<?php

include_once '../../../lib/defaults.php';

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once "$fnsDir/require_user.php";
$user = require_user($base);

include_once '../fns/request_wallet_params.php';
$name = request_wallet_params($errors);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['wallets/new/errors'] = $errors;
    $_SESSION['wallets/new/values'] = ['name' => $name];
    redirect();
}

unset(
    $_SESSION['wallets/new/errors'],
    $_SESSION['wallets/new/values']
);

include_once "$fnsDir/Users/Wallets/add.php";
include_once '../../lib/mysqli.php';
$id = Users\Wallets\add($mysqli, $user->id_users, $name);

unset($_SESSION['wallets/view/errors']);
$_SESSION['wallets/view/messages'] = ['Wallet has been saved.'];

include_once "$fnsDir/ItemList/itemQuery.php";
redirect('../view/'.ItemList\itemQuery($id));
