<?php

namespace ReceivedFolders;

function addDeleted ($mysqli, $id, $sender_address, $sender_id_users,
    $sender_username, $receiver_id_users, $name, $archived, $insert_time) {

    if ($sender_address === null) $sender_address = 'null';
    else $sender_address = "'".$mysqli->real_escape_string($sender_address)."'";
    if ($sender_id_users === null) $sender_id_users = 'null';
    $sender_username = $mysqli->real_escape_string($sender_username);
    $name = $mysqli->real_escape_string($name);
    $archived = $archived ? '1' : '0';

    $sql = 'insert into received_folders'
        .' (id, sender_address, sender_id_users, sender_username,'
        .' receiver_id_users, name, archived, insert_time, committed)'
        ." values ($id, $sender_address, $sender_id_users, '$sender_username',"
        ." $receiver_id_users, '$name', $archived, $insert_time, 1)";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
