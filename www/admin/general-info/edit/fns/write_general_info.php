<?php

function write_general_info ($siteTitle, $domainName, $infoEmail, $siteBase,
    $numReverseProxies, $https, $signupEnabled, $autoUpdateEnabled, &$errors) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/SiteTitle/set.php";
    $ok = SiteTitle\set($siteTitle);
    if ($ok === false) {
        $errors[] = 'Failed to save site title.';
        $focus = 'button';
        return;
    }

    include_once "$fnsDir/DomainName/set.php";
    $ok = DomainName\set($domainName);
    if ($ok === false) {
        $errors[] = 'Failed to save domain name.';
        $focus = 'button';
        return;
    }

    include_once "$fnsDir/InfoEmail/set.php";
    $ok = InfoEmail\set($infoEmail);
    if ($ok === false) {
        $errors[] = 'Failed to save informational email.';
        $focus = 'button';
        return;
    }

    include_once "$fnsDir/SiteBase/set.php";
    $ok = SiteBase\set($siteBase);
    if ($ok === false) {
        $errors[] = 'Failed to save website path.';
        $focus = 'button';
        return;
    }

    include_once "$fnsDir/NumReverseProxies/set.php";
    $ok = NumReverseProxies\set($numReverseProxies);
    if ($ok === false) {
        $errors[] = 'Failed to save reverse proxies.';
        $focus = 'button';
        return;
    }

    include_once "$fnsDir/SiteProtocol/set.php";
    $ok = SiteProtocol\set($https ? 'https' : 'http');
    if ($ok === false) {
        $errors[] = 'Failed to save whether uses HTTPS or not.';
        $focus = 'button';
        return;
    }

    include_once "$fnsDir/SignUpEnabled/set.php";
    $ok = SignUpEnabled\set($signupEnabled);
    if ($ok === false) {
        $errors[] = 'Failed to save whether anyone can sign up or not.';
        $focus = 'button';
    }

    include_once "$fnsDir/AutoUpdateEnabled/set.php";
    $ok = AutoUpdateEnabled\set($autoUpdateEnabled);
    if ($ok === false) {
        $errors[] = 'Failed to save whether'
            .' automatic updates are enabled or disabled.';
        $focus = 'button';
    }

}
