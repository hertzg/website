<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once '../fns/require_user_with_password.php';
$user = require_user_with_password('../');

$id_users = $user->id_users;

include_once "$fnsDir/Username/request.php";
$username = Username\request();

include_once "$fnsDir/Email/request.php";
$email = Email\request();

include_once "$fnsDir/FullName/request.php";
$full_name = FullName\request();

include_once "$fnsDir/request_strings.php";
list($timezone) = request_strings('timezone');

$timezone = (int)$timezone;

include_once "$fnsDir/Timezone/isValid.php";
if (!Timezone\isValid($timezone)) $timezone = 0;

include_once '../../lib/mysqli.php';

include_once "$fnsDir/check_username.php";
check_username($mysqli, $username, $errors, $focus, $id_users);

if (!$errors) {
    include_once "$fnsDir/Password/match.php";
    $match = Password\match($user->password_hash, $user->password_salt,
        $user->password_sha512_hash, $user->password_sha512_key, $username);
    if ($match) {
        $errors[] = 'Please, choose a username'
            .' that is different from your password.';
        $focus = 'username';
    }
}

include_once "$fnsDir/check_email.php";
check_email($email, $errors, $focus);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['account/edit-profile/errors'] = $errors;
    $_SESSION['account/edit-profile/values'] = [
        'focus' => $focus,
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
Users\Account\editProfile($mysqli, $user, $username,
    $email, $full_name, $timezone, (bool)$user->admin,
    (bool)$user->disabled, (bool)$user->expires, $changed);

if ($changed) $message = 'Changes have been saved.';
else $message = 'No changes to be saved.';
$_SESSION['account/messages'] = [$message];

redirect('..');
