<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once '../fns/require_admin.php';
list($generalInfoValues, $mysqlConfigValues, $adminValues) = require_admin();

include_once "$fnsDir/Password/hash.php";
list($sha512_hash, $sha512_key) = Password\hash($adminValues['password']);

include_once "$fnsDir/Admin/set.php";
Admin\set($adminValues['username'], $sha512_hash, $sha512_key);

include_once "$fnsDir/SiteTitle/set.php";
SiteTitle\set($generalInfoValues['siteTitle']);

$domainName = $generalInfoValues['domainName'];
$siteBase = $generalInfoValues['siteBase'];
$siteProtocol = $generalInfoValues['https'] ? 'https' : 'http';

include_once "$fnsDir/DomainName/set.php";
DomainName\set($domainName);

include_once "$fnsDir/InfoEmail/set.php";
InfoEmail\set($generalInfoValues['infoEmail']);

include_once "$fnsDir/MysqlConfig/set.php";
MysqlConfig\set($mysqlConfigValues['host'], $mysqlConfigValues['username'],
    $mysqlConfigValues['password'], $mysqlConfigValues['db']);

include_once "$fnsDir/SiteBase/set.php";
SiteBase\set($siteBase);

include_once "$fnsDir/NumReverseProxies/set.php";
NumReverseProxies\set($generalInfoValues['numReverseProxies']);

include_once "$fnsDir/SiteProtocol/set.php";
SiteProtocol\set($siteProtocol);

include_once "$fnsDir/write_crontab.php";
write_crontab();

include_once "$fnsDir/write_htaccess.php";
write_htaccess($siteBase, $domainName, $siteProtocol);

include_once "$fnsDir/Installed/set.php";
Installed\set(true);

unset(
    $_SESSION['install/general-info/values'],
    $_SESSION['install/mysql-config/values'],
    $_SESSION['install/admin/values']
);

include_once "$fnsDir/redirect.php";
redirect('../done/');
