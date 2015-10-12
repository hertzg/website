<?php

namespace Users\BarCharts;

function indexPage ($mysqli, $user, $offset, $limit, &$total, $order_by) {

    if (!$user->num_bar_charts) {
        $total = 0;
        return [];
    }

    include_once __DIR__.'/../../BarCharts/indexPageOnUser.php';
    return \BarCharts\indexPageOnUser($mysqli,
        $user->id_users, $offset, $limit, $total, $order_by);

}
