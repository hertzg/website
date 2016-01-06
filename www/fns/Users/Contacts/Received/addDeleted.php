<?php

namespace Users\Contacts\Received;

function addDeleted ($mysqli, $receiver_id_users, $data) {

    $archived = $data->archived;

    include_once __DIR__.'/../../../ReceivedContacts/addDeleted.php';
    \ReceivedContacts\addDeleted($mysqli, $data->id,
        $data->sender_address, $data->sender_id_users,
        $data->sender_username, $receiver_id_users,
        $data->full_name, $data->alias, $data->address, $data->email1,
        $data->email1_label, $data->email2, $data->email2_label,
        $data->phone1, $data->phone1_label, $data->phone2,
        $data->phone2_label, $data->birthday_time, $data->username,
        $data->timezone, $data->tags, $data->notes, $data->favorite,
        $archived, $data->insert_time, $data->photo_id);

    include_once __DIR__.'/addNumbers.php';
    addNumbers($mysqli, $receiver_id_users, 1, $archived ? 1 : 0);

}
