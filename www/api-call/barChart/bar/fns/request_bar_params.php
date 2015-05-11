<?php

function request_bar_params () {

    include_once __DIR__.'/../../../../fns/BarChartBars/request.php';
    list($value, $parsed_value, $label) = BarChartBars\request();

    if ($parsed_value === 0) {
        include_once __DIR__.'/../../../fns/bad_request.php';
        bad_request('ENTER_VALUE');
    }

    return [$parsed_value, $label];

}
