<?php

namespace Users\Places;

function indexPage ($mysqli, $user, $offset, $limit, &$total, $order_by) {

    if (!$user->num_places) {
        $total = 0;
        return [];
    }

    include_once __DIR__.'/../../Places/indexPageOnUser.php';
    return \Places\indexPageOnUser($mysqli,
        $user->id_users, $offset, $limit, $total, $order_by);

}
