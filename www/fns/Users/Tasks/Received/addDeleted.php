<?php

namespace Users\Tasks\Received;

function addDeleted ($mysqli, $receiver_id_users, $data) {

    $archived = $data->archived;

    include_once __DIR__.'/../../../ReceivedTasks/addDeleted.php';
    \ReceivedTasks\addDeleted($mysqli, $data->id,
        $data->sender_address, $data->sender_id_users,
        $data->sender_username, $receiver_id_users, $data->text,
        $data->title, $data->deadline_time, $data->tags,
        $data->top_priority, $archived, $data->insert_time);

    include_once __DIR__.'/addNumbers.php';
    addNumbers($mysqli, $receiver_id_users, 1, $archived ? 1 : 0);

}
