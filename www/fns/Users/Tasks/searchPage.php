<?php

namespace Users\Tasks;

function searchPage ($mysqli, $user, $keyword, $offset, $limit, &$total) {

    if (!$user->num_tasks) return [];

    include_once __DIR__.'/../../Tasks/searchPage.php';
    return \Tasks\searchPage($mysqli,
        $user->id_users, $keyword, $offset, $limit, $total);

}
