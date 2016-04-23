<?php

function check_general_info ($siteTitle, $domainName,
    $infoEmail, $siteBase, $numReverseProxies, &$focus) {

    if ($siteTitle === '') {
        $focus = 'siteTitle';
        return 'Enter site title.';
    }

    if ($domainName === '') {
        $focus = 'domainName';
        return 'Enter domain name.';
    }

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/DomainName/isValid.php";
    if (!DomainName\isValid($domainName)) {
        $focus = 'domainName';
        return 'The domain name is invalid';
    }

    if ($infoEmail === '') {
        $focus = 'infoEmail';
        return 'Enter informational email.';
    }

    include_once "$fnsDir/InfoEmail/isValid.php";
    if (!InfoEmail\isValid($infoEmail)) {
        $focus = 'infoEmail';
        return 'The informational email is invalid.';
    }

    if ($siteBase === '') {
        $focus = 'siteBase';
        return 'Enter website path.';
    }

    if (substr($siteBase, 0, 1) !== '/') {
        $focus = 'siteBase';
        return 'The website path should start with slash (<code>/</code>).';
    }

    if (substr($siteBase, -1) !== '/') {
        $focus = 'siteBase';
        return 'The website path should end with slash (<code>/</code>).';
    }

    include_once "$fnsDir/NumReverseProxies/available.php";
    if (!array_key_exists($numReverseProxies, NumReverseProxies\available())) {
        $focus = 'numReverseProxies';
        return 'Select reverse proxies / your IP.';
    }

}
