<?php

namespace ReceivedFiles;

function add ($mysqli, $sender_id_users, $sender_username, $receiver_id_users,
    $file_name, $file_size, $filePath) {

    $sender_username = $mysqli->real_escape_string($sender_username);
    $file_name = $mysqli->real_escape_string($file_name);
    $insert_time = time();

    $sql = 'insert into received_files'
        .' (sender_id_users, sender_username, receiver_id_users,'
        .' file_name, file_size, insert_time)'
        ." values ($sender_id_users, '$sender_username', $receiver_id_users,"
        ." '$file_name', '$file_size', $insert_time)";
    $mysqli->query($sql) || trigger_error($mysqli->error);

    $id = $mysqli->insert_id;

    include_once __DIR__.'/filePath.php';
    $receivedFilePath = filePath($receiver_id_users, $id);

    copy($filePath, $receivedFilePath);

}
