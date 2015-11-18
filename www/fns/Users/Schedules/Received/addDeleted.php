<?php

namespace Users\Schedules\Received;

function addDeleted ($mysqli, $receiver_id_users, $data) {

    $archived = $data->archived;

    include_once __DIR__.'/../../../ReceivedSchedules/addDeleted.php';
    \ReceivedSchedules\addDeleted($mysqli, $data->id,
        $data->sender_address, $data->sender_id_users,
        $data->sender_username, $receiver_id_users,
        $data->text, $data->interval, $data->offset,
        $data->tags, $archived, $data->insert_time);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $receiver_id_users, 1);

    if ($archived) {
        include_once __DIR__.'/addNumberArchived.php';
        addNumberArchived($mysqli, $receiver_id_users, 1);
    }

}
