<?php

function request_general_info_params (&$errors) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($siteTitle, $domainName, $infoEmail,
        $siteBase, $https, $behindProxy, $signupEnabled) = request_strings(
        'siteTitle', 'domainName', 'infoEmail',
        'siteBase', 'https', 'behindProxy', 'signupEnabled');

    include_once "$fnsDir/str_collapse_spaces.php";
    $siteTitle = str_collapse_spaces($siteTitle);
    $infoEmail = str_collapse_spaces($infoEmail);
    $siteBase = str_collapse_spaces($siteBase);

    $domainName = preg_replace('/\s+/', '', $domainName);
    $https = (bool)$https;
    $behindProxy = (bool)$behindProxy;
    $signupEnabled = (bool)$signupEnabled;

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

    return [$siteTitle, $domainName, $infoEmail,
        $siteBase, $https, $behindProxy, $signupEnabled];

}
