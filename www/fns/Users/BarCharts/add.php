<?php

namespace Users\BarCharts;

function add ($mysqli, $id_users, $name, $insertApiKey = null) {

    include_once __DIR__.'/../../BarCharts/add.php';
    $id = \BarCharts\add($mysqli, $id_users, $name, $insertApiKey);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

    return $id;

}
