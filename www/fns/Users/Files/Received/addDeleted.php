<?php

namespace Users\Files\Received;

function addDeleted ($mysqli, $receiver_id_users, $data) {

    $archived = $data->archived;

    include_once __DIR__.'/../../../ReceivedFiles/addDeleted.php';
    \ReceivedFiles\addDeleted($mysqli, $data->id, $data->sender_address,
        $data->sender_id_users, $data->sender_username, $receiver_id_users,
        $data->content_type, $data->media_type, $data->name, $data->size,
        $data->hashes_computed, $data->md5_sum, $data->sha256_sum,
        $archived, $data->insert_time);

    include_once __DIR__.'/addNumbers.php';
    addNumbers($mysqli, $receiver_id_users, 1, $archived ? 1 : 0);

}
