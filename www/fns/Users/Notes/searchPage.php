<?php

namespace Users\Notes;

function searchPage ($mysqli, $user, $includes,
    $excludes, $offset, $limit, &$total) {

    if (!$user->num_notes) return [];

    include_once __DIR__.'/../../Notes/searchPage.php';
    return \Notes\searchPage($mysqli, $user->id_users, $includes,
        $excludes, $offset, $limit, $total, $user->notes_order_by);

}
