<?php

namespace Users\BarCharts;

function searchPage ($mysqli, $user, $includes,
    $excludes, $offset, $limit, &$total) {

    if (!$user->num_bar_charts) return [];

    include_once __DIR__.'/../../BarCharts/searchPage.php';
    return \BarCharts\searchPage($mysqli, $user->id_users, $includes,
        $excludes, $offset, $limit, $total, $user->bar_charts_order_by);

}
