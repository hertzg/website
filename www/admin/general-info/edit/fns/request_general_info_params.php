<?php

function request_general_info_params (&$errors, &$focus) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($siteTitle, $domainName, $infoEmail, $siteBase, $numReverseProxies,
        $https, $signupEnabled, $autoUpdateEnabled) = request_strings(
        'siteTitle', 'domainName', 'infoEmail', 'siteBase', 'numReverseProxies',
        'https', 'signupEnabled', 'autoUpdateEnabled');

    include_once "$fnsDir/str_collapse_spaces.php";
    $siteTitle = str_collapse_spaces($siteTitle);
    $infoEmail = str_collapse_spaces($infoEmail);
    $siteBase = str_collapse_spaces($siteBase);

    $numReverseProxies = abs((int)$numReverseProxies);
    $domainName = preg_replace('/\s+/', '', $domainName);
    $https = (bool)$https;
    $signupEnabled = (bool)$signupEnabled;
    $autoUpdateEnabled = (bool)$autoUpdateEnabled;

    if ($siteTitle === '') {
        $errors[] = 'Enter site title.';
        $focus = 'siteTitle';
    }

    if ($domainName === '') {
        $errors[] = 'Enter domain name.';
        if ($focus === null) $focus = 'domainName';
    } else {
        include_once "$fnsDir/DomainName/isValid.php";
        if (!DomainName\isValid($domainName)) {
            $errors[] = 'The domain name is invalid';
            if ($focus === null) $focus = 'domainName';
        }
    }

    if ($infoEmail === '') {
        $errors[] = 'Enter informational email.';
        if ($focus === null) $focus = 'infoEmail';
    } else {
        include_once "$fnsDir/InfoEmail/isValid.php";
        if (!InfoEmail\isValid($infoEmail)) {
            $errors[] = 'The informational email is invalid.';
            if ($focus === null) $focus = 'infoEmail';
        }
    }

    if ($siteBase === '') {
        $errors[] = 'Enter website path.';
        if ($focus === null) $focus = 'siteBase';
    } elseif (substr($siteBase, 0, 1) !== '/') {
        $errors[] = 'The website path should start with slash (/).';
        if ($focus === null) $focus = 'siteBase';
    } elseif (substr($siteBase, -1) !== '/') {
        $errors[] = 'The website path should end with slash (/).';
        if ($focus === null) $focus = 'siteBase';
    }

    include_once "$fnsDir/NumReverseProxies/available.php";
    if (!array_key_exists($numReverseProxies, NumReverseProxies\available())) {
        $errors[] = 'Select reverse proxies / your IP.';
        if ($focus !== null) $focus = 'numReverseProxies';
    }

    return [$siteTitle, $domainName, $infoEmail, $siteBase,
        $numReverseProxies, $https, $signupEnabled, $autoUpdateEnabled];

}
