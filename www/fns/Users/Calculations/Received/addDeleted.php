<?php

namespace Users\Calculations\Received;

function addDeleted ($mysqli, $receiver_id_users, $data) {

    $archived = $data->archived;

    include_once __DIR__.'/../../../ReceivedCalculations/addDeleted.php';
    \ReceivedCalculations\addDeleted($mysqli, $data->id,
        $data->sender_address, $data->sender_id_users,
        $data->sender_username, $receiver_id_users, $data->expression,
        $data->title, $data->tags, $data->value, $archived, $data->insert_time);

    include_once __DIR__.'/addNumbers.php';
    addNumbers($mysqli, $receiver_id_users, 1, $archived ? 1 : 0);

}
