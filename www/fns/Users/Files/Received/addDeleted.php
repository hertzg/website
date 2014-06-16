<?php

namespace Users\Files\Received;

function addDeleted ($mysqli, $id_users, $data) {

    include_once __DIR__.'/../../../ReceivedFiles/addDeleted.php';
    \ReceivedFiles\addDeleted($mysqli, $data->id, $data->sender_id_users,
        $data->sender_username, $id_users, $data->name, $data->size,
        $data->archived, $data->insert_time);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

}
