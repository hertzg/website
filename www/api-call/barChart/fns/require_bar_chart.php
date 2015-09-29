<?php

function require_bar_chart ($mysqli, $user) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/BarCharts/get.php";
    $bar_chart = Users\BarCharts\get($mysqli, $user, $id);

    if (!$bar_chart) {
        include_once "$fnsDir/ErrorJson/badRequest.php";
        ErrorJson\badRequest('"BAR_CHART_NOT_FOUND"');
    }

    return $bar_chart;

}
