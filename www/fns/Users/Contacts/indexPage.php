<?php

namespace Users\Contacts;

function indexPage ($mysqli, $user, $offset, $limit, &$total, $order_by) {

    if (!$user->num_contacts) {
        $total = 0;
        return [];
    }

    include_once __DIR__.'/../../Contacts/indexPageOnUser.php';
    return \Contacts\indexPageOnUser($mysqli,
        $user->id_users, $offset, $limit, $total, $order_by);

}
