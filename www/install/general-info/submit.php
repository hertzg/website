<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once '../fns/require_requirements.php';
require_requirements();

include_once "$fnsDir/request_strings.php";
list($siteTitle, $domainName, $infoEmail, $siteBase, $https) = request_strings(
    'siteTitle', 'domainName', 'infoEmail', 'siteBase', 'https');

include_once "$fnsDir/str_collapse_spaces.php";
$siteTitle = str_collapse_spaces($siteTitle);
$infoEmail = str_collapse_spaces($infoEmail);
$siteBase = str_collapse_spaces($siteBase);

$domainName = preg_replace('/\s+/', '', $domainName);

$https = (bool)$https;

include_once '../fns/check_general_info.php';
$error = check_general_info($siteTitle,
    $domainName, $infoEmail, $siteBase, $focus);

$_SESSION['install/general-info/values'] = [
    'siteTitle' => $siteTitle,
    'domainName' => $domainName,
    'infoEmail' => $infoEmail,
    'siteBase' => $siteBase,
    'https' => $https,
    'check' => true,
];

include_once "$fnsDir/redirect.php";

if ($error) redirect();

redirect('../mysql-config/');
