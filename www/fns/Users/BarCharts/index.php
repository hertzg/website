<?php

namespace Users\BarCharts;

function index ($mysqli, $user) {

    if (!$user->num_bar_charts) return [];

    include_once __DIR__.'/../../BarCharts/indexOnUser.php';
    return \BarCharts\indexOnUser($mysqli, $user->id_users);

}
