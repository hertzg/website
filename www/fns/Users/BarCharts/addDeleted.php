<?php

namespace Users\BarCharts;

function addDeleted ($mysqli, $id_users, $data) {

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/BarCharts/addDeleted.php";
    \BarCharts\addDeleted($mysqli, $data->id, $id_users, $data->name,
        $data->insert_time, $data->update_time, $data->revision);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

}
