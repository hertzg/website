<?php

function request_bar_params () {

    include_once __DIR__.'/../../../../fns/BarChartBars/request.php';
    list($value, $parsed_value, $label) = BarChartBars\request();

    return [$parsed_value, $label];

}
