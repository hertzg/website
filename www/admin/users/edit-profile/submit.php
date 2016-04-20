<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_user.php';
include_once '../../../lib/mysqli.php';
list($user, $id) = require_user($mysqli);

include_once "$fnsDir/Username/request.php";
$username = Username\request();

include_once "$fnsDir/Email/request.php";
$email = Email\request();

include_once "$fnsDir/FullName/request.php";
$full_name = FullName\request();

include_once "$fnsDir/request_strings.php";
list($timezone, $admin, $disabled, $expires) = request_strings(
    'timezone', 'admin', 'disabled', 'expires');

include_once "$fnsDir/Timezone/isValid.php";
if (!Timezone\isValid($timezone)) $timezone = 0;

$admin = (bool)$admin;
$disabled = (bool)$disabled;
$expires = (bool)$expires;

include_once '../../../lib/mysqli.php';

include_once "$fnsDir/check_username.php";
check_username($mysqli, $username, $errors, $focus, $id);

include_once "$fnsDir/check_email.php";
check_email($email, $errors, $focus);

if (!$errors) {
    include_once "$fnsDir/Password/match.php";
    $match = Password\match($user->password_hash, $user->password_salt,
        $user->password_sha512_hash, $user->password_sha512_key, $username);
    if ($match) {
        $errors[] = 'Please, choose a username that'
            .' is different from the user\'s password.';
    }
}

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['admin/users/edit-profile/errors'] = $errors;
    $_SESSION['admin/users/edit-profile/values'] = [
        'focus' => $focus,
        'username' => $username,
        'email' => $email,
        'full_name' => $full_name,
        'timezone' => $timezone,
        'admin' => $admin,
        'disabled' => $disabled,
        'expires' => $expires,
    ];
    redirect("./$itemQuery");
}

unset(
    $_SESSION['admin/users/edit-profile/errors'],
    $_SESSION['admin/users/edit-profile/values']
);

include_once "$fnsDir/Users/Account/editProfile.php";
Users\Account\editProfile($mysqli, $user, $username, $email,
    $full_name, $timezone, $admin, $disabled, $expires, $changed);

if ($changed) $message = 'Changes have been saved.';
else $message = 'No changes to be saved.';
$_SESSION['admin/users/view/messages'] = [$message];

redirect("../view/$itemQuery");
