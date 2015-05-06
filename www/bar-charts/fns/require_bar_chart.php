<?php

function require_bar_chart ($mysqli, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../");

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/BarCharts/get.php";
    $bar_chart = Users\BarCharts\get($mysqli, $user, $id);

    if (!$bar_chart) {
        $_SESSION['bar-charts/errors'] = ['The bar chart no longer exists.'];
        unset($_SESSION['bar-charts/messages']);
        include_once "$fnsDir/redirect.php";
        redirect("$base..");
    }

    return [$bar_chart, $id, $user];

}
