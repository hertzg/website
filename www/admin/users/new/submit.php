<?php

include_once '../../fns/require_admin.php';
require_admin();

$fnsDir = '../../../fns';

include_once "$fnsDir/request_strings.php";
list($username, $password, $repeatPassword) = request_strings(
    'username', 'password', 'repeatPassword');

include_once "$fnsDir/str_collapse_spaces.php";
$username = str_collapse_spaces($username);

include_once '../../../lib/mysqli.php';

include_once "$fnsDir/check_username.php";
check_username($mysqli, $username, $errors);

include_once "$fnsDir/check_passwords.php";
check_passwords($username, $password, $repeatPassword, $errors);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['admin/users/new/errors'] = $errors;
    $_SESSION['admin/users/new/values'] = [
        'username' => $username,
        'password' => $password,
        'repeatPassword' => $repeatPassword,
    ];
    redirect();
}

unset(
    $_SESSION['admin/users/new/errors'],
    $_SESSION['admin/users/new/values']
);

include_once "$fnsDir/Users/Account/create.php";
$id = Users\Account\create($mysqli, $username, $password, '');

$_SESSION['admin/users/view/messages'] = ['The user has been saved.'];

redirect("../view/?id=$id");