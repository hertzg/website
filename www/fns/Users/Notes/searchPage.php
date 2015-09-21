<?php

namespace Users\Notes;

function searchPage ($mysqli, $user, $keyword, $offset, $limit, &$total) {

    if (!$user->num_notes) return [];

    include_once __DIR__.'/../../Notes/searchPage.php';
    return \Notes\searchPage($mysqli, $user->id_users,
        $keyword, $offset, $limit, $total, $user->notes_order_by);

}
