<?php

function require_general_info () {

    include_once __DIR__.'/require_requirements.php';
    require_requirements();

    $fnsDir = __DIR__.'/../../fns';

    $key = 'install/general-info/values';
    if (!array_key_exists($key, $_SESSION)) {
        include_once "$fnsDir/redirect.php";
        redirect('../general-info/');
    }

    $generalInfoValues = $_SESSION[$key];

    include_once __DIR__.'/check_general_info.php';
    $error = check_general_info($generalInfoValues['siteTitle'],
        $generalInfoValues['domainName'], $generalInfoValues['infoEmail'],
        $generalInfoValues['siteBase'], $focus);

    if ($error) {
        include_once "$fnsDir/redirect.php";
        redirect('../general-info/');
    }

    return $generalInfoValues;

}
