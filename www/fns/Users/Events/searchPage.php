<?php

namespace Users\Events;

function searchPage ($mysqli, $user,
    $includes, $excludes, $offset, $limit, &$total) {

    if (!$user->num_events) return [];

    include_once __DIR__.'/../../Events/searchPage.php';
    return \Events\searchPage($mysqli, $user->id_users, $includes,
        $excludes, $offset, $limit, $total, $user->events_order_by);

}
