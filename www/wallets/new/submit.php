<?php

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once "$fnsDir/require_user.php";
$user = require_user($base);

include_once "$fnsDir/Wallets/request.php";
$name = Wallets\request();

$errors = [];

if ($name === '') $errors[] = 'Enter name.';

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

redirect('..');
