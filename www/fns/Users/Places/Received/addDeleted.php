<?php

namespace Users\Places\Received;

function addDeleted ($mysqli, $receiver_id_users, $data) {

    $archived = $data->archived;

    include_once __DIR__.'/../../../ReceivedPlaces/addDeleted.php';
    \ReceivedPlaces\addDeleted($mysqli, $data->id, $data->sender_id_users,
        $data->sender_username, $receiver_id_users, $data->latitude,
        $data->longitude, $data->altitude, $data->name, $data->description,
        $data->tags, $archived, $data->insert_time);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $receiver_id_users, 1);

    if ($archived) {
        include_once __DIR__.'/addNumberArchived.php';
        addNumberArchived($mysqli, $receiver_id_users, 1);
    }

}
