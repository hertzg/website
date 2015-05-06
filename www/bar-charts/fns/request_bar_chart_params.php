<?php

function request_bar_chart_params (&$errors) {

    include_once __DIR__.'/../../fns/BarCharts/request.php';
    $name = BarCharts\request();

    if ($name === '') $errors[] = 'Enter name.';

    return $name;

}
