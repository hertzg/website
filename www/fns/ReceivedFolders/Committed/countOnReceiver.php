<?php

namespace ReceivedFolders\Committed;

function countOnReceiver ($mysqli, $receiver_id_users) {
    $sql = "select count(*) value from received_folders"
        ." where committed = 1 and receiver_id_users = $receiver_id_users";
    include_once __DIR__.'/../../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql)->value;
}
