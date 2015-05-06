<?php

namespace BarCharts;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($name) = request_strings('name');

    include_once "$fnsDir/str_collapse_spaces.php";
    $name = str_collapse_spaces($name);

    return $name;

}
