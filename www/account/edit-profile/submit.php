<?php

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once "$fnsDir/require_user.php";
$user = require_user('../../');
$id_users = $user->id_users;

include_once "$fnsDir/request_strings.php";
list($username, $email, $full_name, $timezone) = request_strings(
    'username', 'email', 'full_name', 'timezone');

include_once "$fnsDir/Timezone/isValid.php";
if (!Timezone\isValid($timezone)) $timezone = 0;

include_once "$fnsDir/str_collapse_spaces.php";
$full_name = str_collapse_spaces($full_name);

include_once '../../lib/mysqli.php';

include_once "$fnsDir/check_username.php";
check_username($mysqli, $username, $errors, $id_users);

if (!$errors) {
    include_once "$fnsDir/Password/match.php";
    $match = Password\match($user->password_hash, $user->password_salt,
        $user->password_sha512_hash, $user->password_sha512_key, $username);
    if ($match) {
        $errors[] = 'Please, choose a username'
            .' that is different from your password.';
    }
}

$email = str_collapse_spaces($email);
$email = mb_strtolower($email, 'UTF-8');
if ($email !== '') {
    include_once "$fnsDir/Email/isValid.php";
    if (Email\isValid($email)) {
        include_once "$fnsDir/Users/getByEmail.php";
        if (Users\getByEmail($mysqli, $email, $id_users)) {
            $errors[] = 'A username with this email is already registered.'
                .' Try another.';
        }
    } else {
        $errors[] = 'The email address is invalid.';
    }
}

include_once "$fnsDir/redirect.php";

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

include_once "$fnsDir/Users/Account/editProfile.php";
Users\Account\editProfile($mysqli, $user,
    $username, $email, $full_name, $timezone);

$_SESSION['account/messages'] = ['Changes have been saved.'];

redirect('..');
