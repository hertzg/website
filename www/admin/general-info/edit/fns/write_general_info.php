<?php

function write_general_info ($siteTitle, $domainName,
    $infoEmail, $siteBase, $https, $behindProxy, &$errors) {

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

    include_once "$fnsDir/SiteProtocol/set.php";
    $ok = SiteProtocol\set($https ? 'https' : 'http');
    if ($ok === false) {
        $errors[] = 'Failed to save whether uses HTTPS or not.';
        $focus = 'button';
        return;
    }

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
        return;
    }

}
