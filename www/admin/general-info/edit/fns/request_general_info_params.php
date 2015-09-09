<?php

function request_general_info_params () {

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

    return [$siteTitle, $domainName, $infoEmail,
        $siteBase, $https, $behindProxy, $signupEnabled];

}
