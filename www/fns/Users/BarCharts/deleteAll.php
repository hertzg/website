<?php

namespace Users\BarCharts;

function deleteAll ($mysqli, $user, $apiKey = null) {

    if (!$user->num_bar_charts) return;

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/BarCharts/indexOnUser.php";
    $bar_charts = \BarCharts\indexOnUser($mysqli, $id_users);

    if ($bar_charts) {
        include_once __DIR__.'/../DeletedItems/addBarChart.php';
        foreach ($bar_charts as $bar_chart) {
            \Users\DeletedItems\addBarChart($mysqli, $bar_chart, $apiKey);
        }
    }

    include_once "$fnsDir/BarCharts/deleteOnUser.php";
    \BarCharts\deleteOnUser($mysqli, $id_users);

    $sql = 'update users set num_bar_charts = 0, balance_total = 0'
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
