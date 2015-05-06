<?php

namespace Users\BarCharts;

function get ($mysqli, $user, $id) {

    if (!$user->num_bar_charts) return;

    include_once __DIR__.'/../../BarCharts/getOnUser.php';
    return \BarCharts\getOnUser($mysqli, $user->id_users, $id);

}
