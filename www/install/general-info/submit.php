<?php

include_once '../fns/require_requirements.php';
require_requirements();

include_once '../../fns/request_strings.php';
list($domainName, $siteBase, $https) = request_strings(
    'domainName', 'siteBase', 'https');

include_once '../../fns/str_collapse_spaces.php';
$domainName = str_collapse_spaces($domainName);
$siteBase = str_collapse_spaces($siteBase);

$https = (bool)$https;
$error = null;

if ($domainName === '') $error = 'Enter domain name.';
else if ($siteBase === '') $error = 'Enter path to <code>"www"</code> folder.';

$_SESSION['install/general-info/values'] = [
    'domainName' => $domainName,
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
