<?php

namespace Users\Tasks;

function indexPage ($mysqli, $user, $offset, $limit, &$total, $order_by) {

    if (!$user->num_tasks) {
        $total = 0;
        return [];
    }

    include_once __DIR__.'/../../Tasks/indexPageOnUser.php';
    return \Tasks\indexPageOnUser($mysqli,
        $user->id_users, $offset, $limit, $total, $order_by);

}
