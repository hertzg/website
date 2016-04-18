<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once '../../fns/require_admin.php';
require_admin();

include_once "$fnsDir/Username/request.php";
$username = Username\request();

include_once "$fnsDir/Email/request.php";
$email = Email\request();

include_once "$fnsDir/FullName/request.php";
$full_name = FullName\request();

include_once "$fnsDir/request_strings.php";
list($password, $repeatPassword,
    $timezone, $admin, $disabled, $expires) = request_strings(
    'password', 'repeatPassword',
    'timezone', 'admin', 'disabled', 'expires');

include_once "$fnsDir/Timezone/isValid.php";
if (!Timezone\isValid($timezone)) $timezone = 0;

$admin = (bool)$admin;
$disabled = (bool)$disabled;
$expires = (bool)$expires;

include_once '../../../lib/mysqli.php';

include_once "$fnsDir/check_username.php";
check_username($mysqli, $username, $errors, $focus);

include_once "$fnsDir/check_passwords.php";
check_passwords($username, $password, $repeatPassword, $errors, $focus);

if ($email !== '') {
    include_once "$fnsDir/Email/isValid.php";
    if (!Email\isValid($email)) {
        $errors[] = 'The email address is invalid.';
        if ($focus === null) $focus = 'email';
    }
}

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['admin/users/new/errors'] = $errors;
    $_SESSION['admin/users/new/values'] = [
        'focus' => $focus,
        'username' => $username,
        'password' => $password,
        'repeatPassword' => $repeatPassword,
        'email' => $email,
        'full_name' => $full_name,
        'timezone' => $timezone,
        'admin' => $admin,
        'disabled' => $disabled,
        'expires' => $expires,
    ];
    include_once "$fnsDir/ItemList/pageQuery.php";
    redirect('./'.ItemList\pageQuery());
}

unset(
    $_SESSION['admin/users/new/errors'],
    $_SESSION['admin/users/new/values']
);

include_once "$fnsDir/Users/Account/create.php";
$id = Users\Account\create($mysqli, $username, $password,
    $email, $full_name, $timezone, $admin, $disabled, $expires);

$_SESSION['admin/users/view/messages'] = ['User has been saved.'];

include_once "$fnsDir/ItemList/itemQuery.php";
redirect('../view/'.ItemList\itemQuery($id));
