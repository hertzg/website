<?php

include_once '../fns/require_admin.php';
list($generalInfoValues, $mysqlConfigValues, $adminValues) = require_admin();

include_once '../../fns/Password/hash.php';
list($hash, $salt) = Password\hash($adminValues['password1']);

include_once '../../fns/file_put_php.php';
$content =
    "<?php\n\n"
    ."function get_admin (&\$username, &\$hash, &\$salt) {\n"
    .'    $username = '.var_export($adminValues['username'], true).";\n"
    .'    $hash = "'.bin2hex($hash)."\";\n"
    .'    $salt = "'.bin2hex($salt)."\";\n"
    ."}\n";
file_put_php('../../admin/fns/get_admin.php', $content);

$content =
    "<?php\n\n"
    ."function get_domain_name () {\n"
    .'    return '.var_export($generalInfoValues['domainName'], true).";\n"
    ."}\n";
file_put_php('../../fns/get_domain_name.php', $content);

include_once '../../fns/InfoEmail/set.php';
InfoEmail\set($generalInfoValues['infoEmail']);

include_once '../../fns/MysqlConfig/set.php';
MysqlConfig\set($mysqlConfigValues['host'], $mysqlConfigValues['username'],
    $mysqlConfigValues['password'], $mysqlConfigValues['db']);

$content =
    "<?php\n\n"
    ."function get_site_base () {\n"
    .'    return '.var_export($generalInfoValues['siteBase'], true).";\n"
    ."}\n";
file_put_php('../../fns/get_site_base.php', $content);

$content =
    "<?php\n\n"
    ."function get_site_protocol () {\n"
    .'    return \''.($generalInfoValues['https'] ? 'https' : 'http')."';\n"
    ."}\n";
file_put_php('../../fns/get_site_protocol.php', $content);

$content =
    "<?php\n\n"
    ."function installed () {\n"
    ."    return true;\n"
    ."}\n";
file_put_php('../../fns/installed.php', $content);

unset(
    $_SESSION['install/general-info/values'],
    $_SESSION['install/mysql-config/values'],
    $_SESSION['install/admin/values']
);

include_once '../../fns/redirect.php';
redirect('../done/');
