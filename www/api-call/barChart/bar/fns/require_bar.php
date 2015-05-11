<?php

function require_bar ($mysqli, $id_users) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/BarChartBars/getNotDeletedOnUser.php";
    $bar = BarChartBars\getNotDeletedOnUser($mysqli, $id_users, $id);

    if (!$bar) {
        include_once __DIR__.'/../../../fns/bad_request.php';
        bad_request('BAR_NOT_FOUND');
    }

    return $bar;

}
