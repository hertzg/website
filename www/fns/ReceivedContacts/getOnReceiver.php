<?php

namespace ReceivedContacts;

function getOnReceiver ($mysqli, $receiver_id_users, $id) {
    $sql = 'select * from received_contacts'
        ." where receiver_id_users = $receiver_id_users and id = $id";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
