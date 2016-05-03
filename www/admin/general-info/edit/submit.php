<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once '../../fns/require_admin.php';
require_admin();

include_once 'fns/request_general_info_params.php';
list($siteTitle, $domainName, $infoEmail, $siteBase, $numReverseProxies,
    $https, $signupEnabled) = request_general_info_params($errors, $focus);

if (!$errors) {
    include_once 'fns/write_general_info.php';
    write_general_info($siteTitle, $domainName, $infoEmail,
        $siteBase, $numReverseProxies, $https, $errors);
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
        'numReverseProxies' => $numReverseProxies,
        'https' => $https,
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
