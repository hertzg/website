<?php

namespace Users\Bookmarks;

function indexPage ($mysqli, $user, $offset, $limit, &$total, $order_by) {

    if (!$user->num_bookmarks) {
        $total = 0;
        return [];
    }

    include_once __DIR__.'/../../Bookmarks/indexPageOnUser.php';
    return \Bookmarks\indexPageOnUser($mysqli,
        $user->id_users, $offset, $limit, $total, $order_by);

}
