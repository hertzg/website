<?php

function request_bar_params (&$errors) {

    include_once __DIR__.'/../../fns/BarChartBars/request.php';
    $values = BarChartBars\request();
    list($value, $parsed_value, $label) = $values;

    if ($value === '') $errors[] = 'Enter value.';

    return $values;

}
