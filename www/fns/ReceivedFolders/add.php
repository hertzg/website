<?php

namespace ReceivedFolders;

function add ($mysqli, $sender_address, $sender_id_users,
    $sender_username, $receiver_id_users, $name) {

    if ($sender_address === null) $sender_address = 'null';
    else $sender_address = "'".$mysqli->real_escape_string($sender_address)."'";
    if ($sender_id_users === null) $sender_id_users = 'null';
    $sender_username = $mysqli->real_escape_string($sender_username);
    $name = $mysqli->real_escape_string($name);

    $sql = 'insert into received_folders'
        .' (sender_address, sender_id_users,'
        .' sender_username, receiver_id_users, name)'
        ." values ($sender_address, $sender_id_users,"
        ." '$sender_username', $receiver_id_users, '$name')";
    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
