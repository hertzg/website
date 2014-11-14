<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');
$id_users = $user->id_users;

include_once '../../fns/request_strings.php';
list($username, $email, $full_name, $timezone) = request_strings(
    'username', 'email', 'full_name', 'timezone');

include_once '../../fns/Timezone/isValid.php';
if (!Timezone\isValid($timezone)) $timezone = 0;

include_once '../../fns/str_collapse_spaces.php';
$full_name = str_collapse_spaces($full_name);

$errors = [];
include_once '../../lib/mysqli.php';

include_once '../../fns/check_username.php';
check_username($mysqli, $username, $errors, $id_users);

$email = str_collapse_spaces($email);
$email = mb_strtolower($email, 'UTF-8');
if ($email !== '') {
    include_once '../../fns/Email/isValid.php';
    if (Email\isValid($email)) {
        include_once '../../fns/Users/getByEmail.php';
        if (Users\getByEmail($mysqli, $email, $id_users)) {
            $errors[] = 'A username with this email is already registered.'
                .' Try another.';
        }
    } else {
        $errors[] = 'The email address is invalid.';
    }
}

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['account/edit-profile/errors'] = $errors;
    $_SESSION['account/edit-profile/values'] = [
        'username' => $username,
        'email' => $email,
        'full_name' => $full_name,
        'timezone' => $timezone,
    ];
    redirect();
}

unset(
    $_SESSION['account/edit-profile/errors'],
    $_SESSION['account/edit-profile/values']
);

include_once '../../fns/Users/editProfile.php';
Users\editProfile($mysqli, $id_users, $username, $email, $full_name, $timezone);

if ($username !== $user->username) {
    include_once 'fns/update_username.php';
    update_username($mysqli, $id_users, $username);
}

if ($email !== $user->email) {
    include_once '../../fns/Users/Email/invalidate.php';
    Users\Email\invalidate($mysqli, $id_users);
}

if ($username !== $user->username) {
    include_once '../../fns/Connections/editConnectedUser.php';
    Connections\editConnectedUser($mysqli, $id_users, $username);
}

$_SESSION['account/messages'] = ['Changes have been saved.'];

redirect('..');
