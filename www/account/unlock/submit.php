<?php

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once 'fns/require_user_without_password.php';
$user = require_user_without_password();

include_once "$fnsDir/request_strings.php";
list($password, $return) = request_strings('password', 'return');

$errors = [];

if ($password === '') $errors[] = 'Enter password.';
else {

    include_once "$fnsDir/Password/match.php";
    $match = Password\match($user->password_hash,
        $user->password_salt, $user->password_sha512_hash,
        $user->password_sha512_key, $password);

    if (!$match) $errors[] = 'Invalid password.';

}

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['account/unlock/errors'] = $errors;
    $_SESSION['account/unlock/values'] = [
        'password' => $password,
        'return' => $return,
    ];
    redirect();
}

unset(
    $_SESSION['account/unlock/errors'],
    $_SESSION['account/unlock/values']
);

include_once "$fnsDir/Crypto/decrypt.php";
$encryption_key = Crypto\decrypt($password,
    $user->encryption_key, $user->encryption_key_iv);

include_once "$fnsDir/Session/EncryptionKey/set.php";
Session\EncryptionKey\set($encryption_key);

include_once "$fnsDir/format_return.php";
$return = format_return($return);

if ($return === null) $return = '../';

redirect($return);
