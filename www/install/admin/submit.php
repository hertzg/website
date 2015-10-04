<?php

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once '../fns/require_mysql_config.php';
require_mysql_config();

include_once "$fnsDir/request_strings.php";
list($username, $password, $repeatPassword) = request_strings(
    'username', 'password', 'repeatPassword');

include_once "$fnsDir/str_collapse_spaces.php";
$username = str_collapse_spaces($username);

include_once '../fns/check_admin.php';
$error = check_admin($username, $password, $repeatPassword, $focus);

$_SESSION['install/admin/values'] = [
    'username' => $username,
    'password' => $password,
    'repeatPassword' => $repeatPassword,
];

include_once "$fnsDir/redirect.php";

if ($error) redirect();

redirect('../finalize/');
