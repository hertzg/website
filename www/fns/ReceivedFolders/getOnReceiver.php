<?php

namespace ReceivedFolders;

function getOnReceiver ($mysqli, $receiver_id_users, $id) {
    $sql = "select * from received_folders where id = $id"
        ." and receiver_id_users = $receiver_id_users";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
