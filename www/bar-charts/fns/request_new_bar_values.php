<?php

function request_new_bar_values ($key) {

    if (array_key_exists($key, $_SESSION)) return $_SESSION[$key];

    include_once __DIR__.'/../../fns/BarChartBars/request.php';
    list($value, $parsed_value, $label) = BarChartBars\request();

    return [
        'value' => $value,
        'label' => $label,
    ];

}
