<?php

include_once '../fns/require_requirements.php';
require_requirements();

include_once '../../fns/request_strings.php';
list($siteTitle, $domainName, $infoEmail, $siteBase, $https) = request_strings(
    'siteTitle', 'domainName', 'infoEmail', 'siteBase', 'https');

include_once '../../fns/str_collapse_spaces.php';
$siteTitle = str_collapse_spaces($siteTitle);
$infoEmail = str_collapse_spaces($infoEmail);
$siteBase = str_collapse_spaces($siteBase);

$domainName = preg_replace('/\s+/', '', $domainName);

$https = (bool)$https;
$error = null;

include_once '../fns/check_general_info.php';
$error = check_general_info($siteTitle, $domainName, $infoEmail, $siteBase);

$_SESSION['install/general-info/values'] = [
    'siteTitle' => $siteTitle,
    'domainName' => $domainName,
    'infoEmail' => $infoEmail,
    'siteBase' => $siteBase,
    'https' => $https,
];

include_once '../../fns/redirect.php';

if ($error) {
    $_SESSION['install/general-info/error'] = $error;
    redirect();
}

unset(
    $_SESSION['install/general-info/error'],
    $_SESSION['install/mysql-config/error']
);

redirect('../mysql-config/');
