<?php

include_once '../../lib/defaults.php';

$fnsDir = '../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once "$fnsDir/require_guest_user.php";
require_guest_user('../');

include_once "$fnsDir/request_strings.php";
list($email, $return) = request_strings('email', 'return');

include_once "$fnsDir/str_collapse_spaces.php";
$email = str_collapse_spaces($email);

$errors = [];

if ($email === '') {
    $errors[] = 'Enter email.';
    $focus = 'email';
} else {
    include_once "$fnsDir/Email/isValid.php";
    if (Email\isValid($email)) {

        include_once "$fnsDir/Users/getByEmail.php";
        include_once '../lib/mysqli.php';
        $user = Users\getByEmail($mysqli, $email);

        if (!$user) {
            $errors[] = 'User with this email was not found.';
            $focus = 'email';
        }

    } else {
        $errors[] = 'The email address is invalid.';
        $focus = 'email';
    }
}

include_once "$fnsDir/Captcha/check.php";
Captcha\check($errors, $focus);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['email-reset-password/errors'] = $errors;
    $_SESSION['email-reset-password/values'] = [
        'focus' => $focus,
        'email' => $email,
        'return' => $return,
    ];
    redirect();
}

unset(
    $_SESSION['email-reset-password/errors'],
    $_SESSION['email-reset-password/values']
);

include_once "$fnsDir/LinkKey/random.php";
$key = LinkKey\random();

include_once "$fnsDir/Users/editResetPasswordKey.php";
Users\editResetPasswordKey($mysqli, $user->id_users, $key, $return);

include_once "$fnsDir/Captcha/reset.php";
Captcha\reset();

include_once 'fns/send_email.php';
send_email($user, $key);

unset($_SESSION['sign-in/errors']);
$_SESSION['sign-in/messages'] = [
    'Instructions to reset password have been sent to your email address.',
];

if ($return === '') $queryString = '';
else $queryString = '?return='.rawurlencode($return);

redirect("../sign-in/$queryString");
