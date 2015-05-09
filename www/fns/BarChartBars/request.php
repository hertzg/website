<?php

namespace BarChartBars;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($value, $label) = request_strings('value', 'label');

    $value = preg_replace('/\s+/', '', $value);
    $parsed_value = (float)$value;

    include_once "$fnsDir/str_collapse_spaces.php";
    $label = str_collapse_spaces($label);

    return [$value, $parsed_value, $label];

}
