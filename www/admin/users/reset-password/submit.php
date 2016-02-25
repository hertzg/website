<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_user.php';
include_once '../../../lib/mysqli.php';
list($user, $id) = require_user($mysqli);

include_once "$fnsDir/request_strings.php";
list($password, $repeatPassword) = request_strings(
    'password', 'repeatPassword');

include_once "$fnsDir/check_reset_passwords.php";
check_reset_passwords($user->username,
    $password, $repeatPassword, $errors, $focus);

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['admin/users/reset-password/errors'] = $errors;
    $_SESSION['admin/users/reset-password/values'] = [
        'focus' => $focus,
        'password' => $password,
        'repeatPassword' => $repeatPassword,
    ];
    redirect("./$itemQuery");
}

unset(
    $_SESSION['admin/users/reset-password/errors'],
    $_SESSION['admin/users/reset-password/values']
);

include_once "$fnsDir/Users/resetPassword.php";
Users\resetPassword($mysqli, $id, $password);

$_SESSION['admin/users/view/messages'] = ['Password has been reset.'];

redirect("../view/$itemQuery");
