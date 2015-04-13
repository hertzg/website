<?php

include_once '../fns/require_admin.php';
list($generalInfoValues, $mysqlConfigValues, $adminValues) = require_admin();

$fnsDir = '../../fns';

include_once "$fnsDir/Password/hash.php";
list($hash, $salt) = Password\hash($adminValues['password1']);

include_once "$fnsDir/Admin/set.php";
Admin\set($adminValues['username'], $hash, $salt);

include_once "$fnsDir/SiteTitle/set.php";
SiteTitle\set($generalInfoValues['siteTitle']);

include_once "$fnsDir/DomainName/set.php";
DomainName\set($generalInfoValues['domainName']);

include_once "$fnsDir/InfoEmail/set.php";
InfoEmail\set($generalInfoValues['infoEmail']);

include_once "$fnsDir/MysqlConfig/set.php";
MysqlConfig\set($mysqlConfigValues['host'], $mysqlConfigValues['username'],
    $mysqlConfigValues['password'], $mysqlConfigValues['db']);

include_once "$fnsDir/SiteBase/set.php";
SiteBase\set($generalInfoValues['siteBase']);

include_once "$fnsDir/SiteProtocol/set.php";
SiteProtocol\set($generalInfoValues['https'] ? 'https' : 'http');

include_once "$fnsDir/write_crontab.php";
write_crontab();

include_once "$fnsDir/write_htaccess.php";
write_htaccess();

include_once "$fnsDir/Installed/set.php";
Installed\set(true);

unset(
    $_SESSION['install/general-info/values'],
    $_SESSION['install/mysql-config/values'],
    $_SESSION['install/admin/values']
);

include_once "$fnsDir/redirect.php";
redirect('../done/');
