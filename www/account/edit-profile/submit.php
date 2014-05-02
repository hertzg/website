<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');
$id_users = $user->id_users;

include_once '../../fns/request_strings.php';
list($email, $full_name) = request_strings('email', 'full_name');

include_once '../../fns/str_collapse_spaces.php';
$full_name = str_collapse_spaces($full_name);

$errors = [];

$email = str_collapse_spaces($email);
$email = mb_strtolower($email, 'UTF-8');
if ($email === '') {
    $errors[] = 'Enter email.';
} else {
    include_once '../../fns/is_email_valid.php';
    if (!is_email_valid($email)) {
        $errors[] = 'Enter a valid email address.';
    } else {
        include_once '../../fns/Users/getByEmail.php';
        include_once '../../lib/mysqli.php';
        if (Users\getByEmail($mysqli, $email, $id_users)) {
            $errors[] = 'A username with this email is already registered. Try another.';
        }
    }
}

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['account/edit-profile/errors'] = $errors;
    $_SESSION['account/edit-profile/values'] = [
        'email' => $email,
        'full_name' => $full_name,
    ];
    redirect();
}

unset(
    $_SESSION['account/edit-profile/errors'],
    $_SESSION['account/edit-profile/values']
);

include_once '../../fns/Users/editProfile.php';
Users\editProfile($mysqli, $id_users, $email, $full_name);

if ($email !== $user->email) {
    include_once '../../fns/Users/Email/invalidate.php';
    Users\Email\invalidate($mysqli, $id_users);
}

$_SESSION['account/messages'] = ['Changes have been saved.'];

redirect('..');
