<?php

namespace Users\BarCharts;

function search ($mysqli, $user, $keyword) {

    if (!$user->num_bar_charts) return [];

    include_once __DIR__.'/../../BarCharts/search.php';
    return \BarCharts\search($mysqli, $user->id_users, $keyword);

}
