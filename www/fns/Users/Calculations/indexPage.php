<?php

namespace Users\Calculations;

function indexPage ($mysqli, $user, $offset, $limit, &$total, $order_by) {

    if (!$user->num_calculations) {
        $total = 0;
        return [];
    }

    include_once __DIR__.'/../../Calculations/indexPageOnUser.php';
    return \Calculations\indexPageOnUser($mysqli,
        $user->id_users, $offset, $limit, $total, $order_by);

}
