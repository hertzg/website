<?php

namespace Users\BarCharts;

function add ($mysqli, $id_users, $name,
    $tags, $tag_names, $insertApiKey = null) {

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/BarCharts/add.php";
    $id = \BarCharts\add($mysqli, $id_users,
        $name, $tags, $tag_names, $insertApiKey);

    if ($tag_names) {
        include_once "$fnsDir/BarChartTags/add.php";
        \BarChartTags\add($mysqli, $id_users, $id, $tag_names, $name, $tags);
    }

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

    return $id;

}
