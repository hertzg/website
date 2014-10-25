<?php

include_once '../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_guest_user.php';
require_guest_user('../');

include_once '../fns/request_strings.php';
list($email) = request_strings('email');

include_once '../fns/str_collapse_spaces.php';
$email = str_collapse_spaces($email);

$errors = [];

if ($email === '') $errors[] = 'Enter email.';
else {
    include_once '../fns/Email/isValid.php';
    if (Email\isValid($email)) {

        include_once '../fns/Users/getByEmail.php';
        include_once '../lib/mysqli.php';
        $user = Users\getByEmail($mysqli, $email);

        if (!$user) {
            $errors[] = 'User with this email was not found.';
        }

    } else {
        $errors[] = 'The email address is invalid.';
    }
}

include_once '../fns/Captcha/check.php';
Captcha\check($errors);

include_once '../fns/redirect.php';

if ($errors) {
    $_SESSION['email-reset-password/errors'] = $errors;
    $_SESSION['email-reset-password/values'] = ['email' => $email];
    redirect();
}

unset(
    $_SESSION['email-reset-password/errors'],
    $_SESSION['email-reset-password/values']
);

$key = md5(uniqid(), true);

include_once '../fns/Users/editResetPasswordKey.php';
Users\editResetPasswordKey($mysqli, $user->id_users, $key);

include_once '../fns/Captcha/reset.php';
Captcha\reset();

include_once 'fns/send_email.php';
send_email($user, $key);

unset($_SESSION['sign-in/errors']);
$_SESSION['sign-in/messages'] = [
    'Instructions to reset password have been sent to your email address.',
];

redirect('../sign-in/');
