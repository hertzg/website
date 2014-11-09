<?php

include_once '../fns/require_admin.php';
list($generalInfoValues, $mysqlConfigValues, $adminValues) = require_admin();

include_once '../../fns/Password/hash.php';
list($hash, $salt) = Password\hash($adminValues['password1']);

include_once '../../fns/Admin/set.php';
Admin\set($adminValues['username'], $hash, $salt);

include_once '../../fns/DomainName/set.php';
DomainName\set($generalInfoValues['domainName']);

include_once '../../fns/InfoEmail/set.php';
InfoEmail\set($generalInfoValues['infoEmail']);

include_once '../../fns/MysqlConfig/set.php';
MysqlConfig\set($mysqlConfigValues['host'], $mysqlConfigValues['username'],
    $mysqlConfigValues['password'], $mysqlConfigValues['db']);

include_once '../../fns/SiteBase/set.php';
SiteBase\set($generalInfoValues['siteBase']);

include_once '../../fns/SiteProtocol/set.php';
SiteProtocol\set($generalInfoValues['https'] ? 'https' : 'http');

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
