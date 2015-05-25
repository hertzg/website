<?php

namespace Users\BarCharts;

function add ($mysqli, $id_users, $name,
    $tags, $tag_names, $insertApiKey = null) {

    include_once __DIR__.'/../../BarCharts/add.php';
    $id = \BarCharts\add($mysqli, $id_users,
        $name, $tags, $tag_names, $insertApiKey);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

    return $id;

}
