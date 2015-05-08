<?php

function request_new_bar_values ($key) {
    if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
    else {

        include_once __DIR__.'/../../fns/BarChartBars/request.php';
        list($value, $parsed_value, $label) = BarChartBars\request();

        $values = [
            'value' => $value,
            'label' => $label,
        ];

    }
    return $values;
}
