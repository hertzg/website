<?php

namespace BarCharts;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($name, $tags) = request_strings('name', 'tags');

    include_once "$fnsDir/str_collapse_spaces.php";
    $name = str_collapse_spaces($name);
    $tags = str_collapse_spaces($tags);

    return [$name, $tags];

}
