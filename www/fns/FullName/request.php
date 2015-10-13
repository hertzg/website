<?php

namespace FullName;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($full_name) = request_strings('full_name');

    include_once "$fnsDir/str_collapse_spaces.php";
    $full_name = str_collapse_spaces($full_name);

    include_once __DIR__.'/maxLength.php';
    return mb_substr($full_name, 0, maxLength(), 'UTF-8');

}
