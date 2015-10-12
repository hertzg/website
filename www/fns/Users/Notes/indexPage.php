<?php

namespace Users\Notes;

function indexPage ($mysqli, $user, $offset, $limit, &$total, $order_by) {

    if (!$user->num_notes) {
        $total = 0;
        return [];
    }

    include_once __DIR__.'/../../Notes/indexPageOnUser.php';
    return \Notes\indexPageOnUser($mysqli,
        $user->id_users, $offset, $limit, $total, $order_by);

}
