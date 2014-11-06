<?php

include_once '../fns/require_mysql_config.php';
list($generalInfoValues, $mysqlConfigValues) = require_mysql_config();

include_once '../../fns/file_put_php.php';
$content =
    "<?php\n\n"
    ."function get_domain_name () {\n"
    .'    return '.var_export($generalInfoValues['domainName'], true)."\n"
    ."}\n";
file_put_php('../../fns/get_domain_name.php', $content);

$content =
    "<?php\n\n"
    ."function get_mysqli_config (&\$host, &\$username, &\$password, &\$db) {\n"
    .'    $host = '.var_export($mysqlConfigValues['host'], true).";\n"
    .'    $username = '.var_export($mysqlConfigValues['username'], true).";\n"
    .'    $password = '.var_export($mysqlConfigValues['password'], true).";\n"
    .'    $db = '.var_export($mysqlConfigValues['db'], true).";\n"
    ."}\n";
file_put_php('../../fns/get_mysqli_config.php', $content);

$content =
    "<?php\n\n"
    ."function get_site_base () {\n"
    .'    return '.var_export($generalInfoValues['siteBase'], true)."\n"
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
    $_SESSION['install/mysql-config/values']
);

include_once '../../fns/redirect.php';
redirect('../done/');
