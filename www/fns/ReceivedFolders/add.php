<?php

namespace ReceivedFolders;

function add ($mysqli, $sender_id_users,
    $sender_username, $receiver_id_users, $name) {

    $sender_username = $mysqli->real_escape_string($sender_username);
    $name = $mysqli->real_escape_string($name);
    $insert_time = time();

    $sql = 'insert into received_folders'
        .' (sender_id_users, sender_username,'
        .' receiver_id_users, name, insert_time)'
        ." values ($sender_id_users, '$sender_username',"
        ." $receiver_id_users, '$name', $insert_time)";
    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
