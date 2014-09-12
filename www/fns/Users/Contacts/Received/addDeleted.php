<?php

namespace Users\Contacts\Received;

function addDeleted ($mysqli, $receiver_id_users, $data) {

    $archived = $data->archived;

    include_once __DIR__.'/../../../ReceivedContacts/addDeleted.php';
    \ReceivedContacts\addDeleted($mysqli, $data->id, $data->sender_id_users,
        $data->sender_username, $receiver_id_users, $data->full_name,
        $data->alias, $data->address, $data->email, $data->phone1,
        $data->phone2, $data->birthday_time, $data->username, $data->timezone,
        $data->tags, $data->favorite, $archived, $data->insert_time,
        $data->photo_id);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $receiver_id_users, 1);

    if ($archived) {
        include_once __DIR__.'/addNumberArchived.php';
        addNumberArchived($mysqli, $receiver_id_users, 1);
    }

}
