<?php

namespace Files;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($name) = request_strings('name');

    include_once "$fnsDir/str_collapse_spaces.php";
    $name = str_collapse_spaces($name);

    include_once __DIR__.'/maxLengths.php';
    $name = mb_substr($name, 0, maxLengths()['name']);

    return $name;

}
