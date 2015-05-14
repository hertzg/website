<?php

namespace Users\DeletedItems;

function purgeBarChart ($mysqli, $deletedItem) {

    $data = json_decode($deletedItem->data_json);

    include_once __DIR__.'/../../BarChartBars/deleteOnBarChart.php';
    \BarChartBars\deleteOnBarChart($mysqli, $data->id);

}
