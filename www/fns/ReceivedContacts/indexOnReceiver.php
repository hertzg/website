<?php

namespace ReceivedContacts;

function indexOnReceiver ($mysqli, $receiver_id_users) {
    $sql = 'select * from received_contacts'
        ." where receiver_id_users = $receiver_id_users"
        .' order by insert_time desc';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
