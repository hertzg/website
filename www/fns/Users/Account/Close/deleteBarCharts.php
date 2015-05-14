<?php

namespace Users\Account\Close;

function deleteBarCharts ($mysqli, $user) {

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../../..';

    if ($user->num_bar_charts) {

        include_once "$fnsDir/BarCharts/deleteOnUser.php";
        \BarCharts\deleteOnUser($mysqli, $id_users);

        include_once "$fnsDir/BarChartBars/deleteOnUser.php";
        \BarChartBars\deleteOnUser($mysqli, $id_users);

    }

}
