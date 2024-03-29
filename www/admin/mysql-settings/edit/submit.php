<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once '../../fns/require_admin.php';
require_admin();

include_once "$fnsDir/request_strings.php";
list($host, $username, $password, $db) = request_strings(
    'host', 'username', 'password', 'db');

include_once "$fnsDir/str_collapse_spaces.php";
$host = str_collapse_spaces($host);
$db = str_collapse_spaces($db);

$errors = [];

if ($db === '') $errors[] = 'Enter database.';

if (!$errors) {

    include_once "$fnsDir/MysqlConfig/get.php";
    MysqlConfig\get($current_host, $current_username,
        $current_password, $current_db);

    if ($host === $current_host && $username === $current_username &&
        $password === $current_password && $db === $current_db) {

        $changed = false;

    } else {
        $changed = true;
        include_once "$fnsDir/MysqlConfig/set.php";
        $ok = MysqlConfig\set($host, $username, $password, $db);
        if ($ok === false) $errors[] = 'Failed to save the data.';
    }

}

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['admin/mysql-settings/edit/errors'] = $errors;
    $_SESSION['admin/mysql-settings/edit/values'] = [
        'host' => $host,
        'username' => $username,
        'password' => $password,
        'db' => $db,
    ];
    redirect();
}

if ($changed) $messages = 'Changes have been saved.';
else $messages = 'No changes to be saved.';
$_SESSION['admin/mysql-settings/messages'] = [$messages];

redirect('..');
