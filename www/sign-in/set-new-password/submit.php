<?php

include_once '../../../lib/defaults.php';

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once 'fns/require_user_with_reset_password.php';
$user = require_user_with_reset_password();

include_once '../../fns/request_strings.php';
list($password, $repeatPassword, $return) = request_strings(
    'password', 'repeatPassword', 'return');

include_once '../../fns/check_reset_passwords.php';
check_reset_passwords($user->username, $password, $repeatPassword,
    $errors, $focus, function (&$errors, &$focus) use ($user, $password) {

    include_once '../../fns/Password/match.php';
    $same = Password\match($user->password_hash, $user->password_salt,
        $user->password_sha512_hash, $user->password_sha512_key, $password);
    if ($same) {
        $errors[] = 'Please, choose a password that is'
            .' different from your current password.';
        $focus = 'password';
    }

});

if ($errors) {
    $_SESSION['sign-in/set-new-password/errors'] = $errors;
    $_SESSION['sign-in/set-new-password/values'] = [
        'focus' => $focus,
        'password' => $password,
        'repeatPassword' => $repeatPassword,
        'return' => $return,
    ];
    include_once '../../fns/redirect.php';
    redirect();
}

unset(
    $_SESSION['sign-in/set-new-password/errors'],
    $_SESSION['sign-in/set-new-password/values']
);

include_once '../../fns/Users/resetPassword.php';
include_once '../../lib/mysqli.php';
Users\resetPassword($mysqli, $user->id_users, $password, false);

include_once 'fns/redirect_back.php';
redirect_back($return);
