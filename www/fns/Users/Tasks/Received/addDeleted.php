<?php

namespace Users\Tasks\Received;

function addDeleted ($mysqli, $receiver_id_users, $data) {

    $archived = $data->archived;

    include_once __DIR__.'/../../../ReceivedTasks/addDeleted.php';
    \ReceivedTasks\addDeleted($mysqli, $data->id, $data->sender_id_users,
        $data->sender_username, $receiver_id_users, $data->text,
        $data->tags, $data->top_priority, $archived, $data->insert_time);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $receiver_id_users, 1);

    if ($archived) {
        include_once __DIR__.'/addNumberArchived.php';
        addNumberArchived($mysqli, $receiver_id_users, 1);
    }

}
