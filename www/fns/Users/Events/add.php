<?php

namespace Users\Events;

function add ($mysqli, $user, $event_text, $event_time) {

    $id_users = $user->id_users;

    include_once __DIR__.'/../../Events/add.php';
    $id = \Events\add($mysqli, $id_users, $event_text, $event_time);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

    include_once __DIR__.'/invalidateIfNeeded.php';
    invalidateIfNeeded($mysqli, $user, $event_time);

    return $id;

}
