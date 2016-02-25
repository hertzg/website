<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once '../fns/require_mysql_config.php';
require_mysql_config();

include_once "$fnsDir/Username/request.php";
$username = Username\request('username');

include_once "$fnsDir/request_strings.php";
list($password, $repeatPassword) = request_strings(
    'password', 'repeatPassword');

include_once '../fns/check_admin.php';
$error = check_admin($username, $password, $repeatPassword, $focus);

$_SESSION['install/admin/values'] = [
    'username' => $username,
    'password' => $password,
    'repeatPassword' => $repeatPassword,
    'check' => true,
];

include_once "$fnsDir/redirect.php";

if ($error) redirect();

redirect('../finalize/');
