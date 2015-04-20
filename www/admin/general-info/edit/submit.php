<?php

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once '../../fns/require_admin.php';
require_admin();

include_once "$fnsDir/request_strings.php";
list($siteTitle, $domainName, $infoEmail, $siteBase, $https) = request_strings(
    'siteTitle', 'domainName', 'infoEmail', 'siteBase', 'https');

include_once "$fnsDir/str_collapse_spaces.php";
$siteTitle = str_collapse_spaces($siteTitle);
$infoEmail = str_collapse_spaces($infoEmail);
$siteBase = str_collapse_spaces($siteBase);

$domainName = preg_replace('/\s+/', '', $domainName);
$https = (bool)$https;

$errors = [];

if ($siteTitle === '') $errors[] = 'Enter site title.';

if ($domainName === '') $errors[] = 'Enter domain name.';
else {
    include_once "$fnsDir/DomainName/isValid.php";
    if (!DomainName\isValid($domainName)) {
        $errors[] = 'The domain name is invalid';
    }
}

if ($infoEmail === '') $errors[] = 'Enter informational email.';
else {
    include_once "$fnsDir/InfoEmail/isValid.php";
    if (!InfoEmail\isValid($infoEmail)) {
        $errors[] = 'The informational email is invalid.';
    }
}

if ($siteBase === '') {
    $errors[] = 'Enter path to "www" folder.';
} elseif (substr($siteBase, 0, 1) !== '/') {
    $errors[] = 'The path to "www" folder should start with slash (/).';
} elseif (substr($siteBase, -1) !== '/') {
    $errors[] = 'The path to "www" folder should end with slash (/).';
}

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['admin/general-info/edit/errors'] = $errors;
    $_SESSION['admin/general-info/edit/values'] = [
        'siteTitle' => $siteTitle,
        'domainName' => $domainName,
        'infoEmail' => $infoEmail,
        'siteBase' => $siteBase,
        'https' => $https,
    ];
    redirect();
}

unset(
    $_SESSION['admin/general-info/edit/errors'],
    $_SESSION['admin/general-info/edit/values']
);

$_SESSION['admin/general-info/messages'] = ['Changed have been saved.'];

include_once "$fnsDir/SiteTitle/set.php";
SiteTitle\set($siteTitle);

include_once "$fnsDir/DomainName/set.php";
DomainName\set($domainName);

include_once "$fnsDir/InfoEmail/set.php";
InfoEmail\set($infoEmail);

include_once "$fnsDir/SiteBase/set.php";
SiteBase\set($siteBase);

include_once "$fnsDir/SiteProtocol/set.php";
SiteProtocol\set($https ? 'https' : 'http');

redirect('..');
