<?php

namespace Users\Tasks\Received;

function addDeleted ($mysqli, $receiver_id_users, $data) {

    include_once __DIR__.'/../../../ReceivedTasks/addDeleted.php';
    \ReceivedTasks\addDeleted($mysqli, $data->id, $data->sender_id_users,
        $data->sender_username, $receiver_id_users, $data->text,
        $data->top_priority, $data->tags, $data->archived, $data->insert_time);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $receiver_id_users, 1);

}
