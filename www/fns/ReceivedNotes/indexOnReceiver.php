<?php

namespace ReceivedNotes;

function indexOnReceiver ($mysqli, $receiver_id_users) {
    $sql = 'select * from received_notes'
        ." where receiver_id_users = $receiver_id_users";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
