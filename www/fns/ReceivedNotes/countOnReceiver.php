<?php

namespace ReceivedNotes;

function countOnReceiver ($mysqli, $receiver_id_users) {
    $sql = "select count(*) value from received_notes"
        ." where receiver_id_users = $receiver_id_users";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql)->value;
}
