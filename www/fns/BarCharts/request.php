<?php

namespace BarCharts;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($name, $tags) = request_strings('name', 'tags');

    include_once __DIR__.'/maxLengths.php';
    $maxLengths = maxLengths();

    include_once "$fnsDir/str_collapse_spaces.php";
    $name = str_collapse_spaces($name);
    $name = mb_substr($name, 0, $maxLengths['name'], 'UTF-8');

    $tags = str_collapse_spaces($tags);
    $tags = mb_substr($tags, 0, $maxLengths['tags'], 'UTF-8');

    return [$name, $tags];

}
