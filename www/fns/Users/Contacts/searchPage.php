<?php

namespace Users\Contacts;

function searchPage ($mysqli, $user, $includes,
    $excludes, $offset, $limit, &$total) {

    if (!$user->num_contacts) return [];

    include_once __DIR__.'/../../Contacts/searchPage.php';
    return \Contacts\searchPage($mysqli, $user->id_users, $includes,
        $excludes, $offset, $limit, $total, $user->contacts_order_by);

}
