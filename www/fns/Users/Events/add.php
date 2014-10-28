<?php

namespace Users\Events;

function add ($mysqli, $user, $text, $event_time, $insertApiKey = null) {

    $id_users = $user->id_users;

    include_once __DIR__.'/../../Events/add.php';
    $id = \Events\add($mysqli, $id_users, $text, $event_time, $insertApiKey);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

    include_once __DIR__.'/invalidateIfNeeded.php';
    invalidateIfNeeded($mysqli, $user, $event_time);

    return $id;

}
