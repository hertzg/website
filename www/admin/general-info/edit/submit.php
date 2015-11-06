<?php

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once '../../fns/require_admin.php';
require_admin();

include_once 'fns/request_general_info_params.php';
list($siteTitle, $domainName, $infoEmail,
    $siteBase, $https, $behindProxy,
    $signupEnabled) = request_general_info_params($errors, $focus);

if (!$errors) {
    include_once "$fnsDir/SiteTitle/set.php";
    $ok = SiteTitle\set($siteTitle);
    if ($ok === false) {
        $errors[] = 'Failed to save site title.';
        $focus = 'button';
    }
}

if (!$errors) {
    include_once "$fnsDir/DomainName/set.php";
    $ok = DomainName\set($domainName);
    if ($ok === false) {
        $errors[] = 'Failed to save domain name.';
        $focus = 'button';
    }
}

if (!$errors) {
    include_once "$fnsDir/InfoEmail/set.php";
    $ok = InfoEmail\set($infoEmail);
    if ($ok === false) {
        $errors[] = 'Failed to save informational email.';
        $focus = 'button';
    }
}

if (!$errors) {
    include_once "$fnsDir/SiteBase/set.php";
    $ok = SiteBase\set($siteBase);
    if ($ok === false) {
        $errors[] = 'Failed to save path to "www" folder.';
        $focus = 'button';
    }
}

if (!$errors) {
    include_once "$fnsDir/SiteProtocol/set.php";
    $ok = SiteProtocol\set($https ? 'https' : 'http');
    if ($ok === false) {
        $errors[] = 'Failed to save whether uses HTTPS or not.';
        $focus = 'button';
    }
}

if (!$errors) {
    if ($behindProxy) {
        include_once "$fnsDir/ClientAddress/GetMethod/setBehindProxy.php";
        $ok = ClientAddress\GetMethod\setBehindProxy();
    } else {
        include_once "$fnsDir/ClientAddress/GetMethod/setDirect.php";
        $ok = ClientAddress\GetMethod\setDirect();
    }
    if ($ok === false) {
        $errors[] = 'Failed to save whether behind reverse proxy or not.';
        $focus = 'button';
    }
}

if (!$errors) {
    include_once "$fnsDir/SignUpEnabled/set.php";
    $ok = SignUpEnabled\set($signupEnabled);
    if ($ok === false) {
        $errors[] = 'Failed to save whether anyone can sign up or not.';
        $focus = 'button';
    }
}

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['admin/general-info/edit/errors'] = $errors;
    $_SESSION['admin/general-info/edit/values'] = [
        'focus' => $focus,
        'siteTitle' => $siteTitle,
        'domainName' => $domainName,
        'infoEmail' => $infoEmail,
        'siteBase' => $siteBase,
        'https' => $https,
        'behindProxy' => $behindProxy,
        'signupEnabled' => $signupEnabled,
    ];
    redirect();
}

unset(
    $_SESSION['admin/general-info/edit/errors'],
    $_SESSION['admin/general-info/edit/values']
);

$_SESSION['admin/general-info/messages'] = ['Changed have been saved.'];

redirect('..');
