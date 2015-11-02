<?php

function require_bar_params (&$parsed_value, &$label) {

    include_once __DIR__.'/../../../../fns/BarChartBars/request.php';
    list($value, $parsed_value, $label) = BarChartBars\request();

}
