<?php

namespace Users\Tasks;

function searchPage ($mysqli, $user, $includes,
    $excludes, $offset, $limit, &$total) {

    if (!$user->num_tasks) return [];

    include_once __DIR__.'/../../Tasks/searchPage.php';
    return \Tasks\searchPage($mysqli, $user->id_users, $includes,
        $excludes, $offset, $limit, $total, $user->tasks_order_by);

}
