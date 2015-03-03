<?php

namespace Users\Events;

function addDeleted ($mysqli, $user, $data) {

    $id_users = $user->id_users;
    $event_time = $data->event_time;

    include_once __DIR__.'/../../Events/addDeleted.php';
    \Events\addDeleted($mysqli, $data->id, $id_users, $data->text, $event_time,
        $data->insert_time, $data->update_time, $data->revision);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

    include_once __DIR__.'/invalidateIfNeeded.php';
    invalidateIfNeeded($mysqli, $user, $event_time);

}
