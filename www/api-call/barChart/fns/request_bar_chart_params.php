<?php

function request_bar_chart_params () {

    include_once __DIR__.'/../../../fns/BarCharts/request.php';
    $name = BarCharts\request();

    if ($name === '') {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('ENTER_NAME');
    }

    return $name;

}
