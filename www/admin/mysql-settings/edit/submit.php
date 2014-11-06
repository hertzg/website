<?php

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

    $content =
        "<?php\n\n"
        ."function get_mysqli_config (&\$host, &\$username, &\$password, &\$db) {\n"
        ."    \$host = ".var_export($host, true).";\n"
        ."    \$username = ".var_export($username, true).";\n"
        ."    \$password = ".var_export($password, true).";\n"
        ."    \$db = ".var_export($db, true).";\n"
        ."}\n";

    include_once "$fnsDir/file_put_php.php";
    $filename = '../../../fns/get_mysqli_config.php';
    $ok = @file_put_php($filename, $content);
    if (!$ok) $errors[] = 'Failed to save the data.';

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

$_SESSION['admin/mysql-settings/messages'] = ['Settings have been saved.'];
redirect('..');
