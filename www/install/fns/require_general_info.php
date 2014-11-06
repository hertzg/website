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

    $values = $_SESSION[$key];

    if ($values['domainName'] === '' || $values['siteBase'] === '') {
        include_once "$fnsDir/redirect.php";
        redirect('../general-info/');
    }

    return $values;

}
