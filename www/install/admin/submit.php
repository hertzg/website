<?php

include_once '../fns/require_mysql_config.php';
require_mysql_config();

include_once '../../fns/request_strings.php';
list($username, $password1, $password2) = request_strings(
    'username', 'password1', 'password2');

include_once '../../fns/str_collapse_spaces.php';
$username = str_collapse_spaces($username);

include_once 'fns/check_username.php';
$error = check_username($username);

if ($error === null) {
    include_once 'fns/check_passwords.php';
    $error = check_passwords($username, $password1, $password2);
}

$_SESSION['install/admin/values'] = [
    'username' => $username,
    'password1' => $password1,
    'password2' => $password2,
];

include_once '../../fns/redirect.php';

if ($error) {
    $_SESSION['install/admin/error'] = $error;
    redirect();
}

unset($_SESSION['install/admin/error']);

redirect('../finalize/');
