<?php

namespace ReceivedFiles;

function add ($mysqli, $sender_id_users,
    $sender_username, $receiver_id_users, $name, $size) {

    $sender_username = $mysqli->real_escape_string($sender_username);
    $name = $mysqli->real_escape_string($name);

    $sql = 'insert into received_files'
        .' (sender_id_users, sender_username,'
        .' receiver_id_users, name, size)'
        ." values ($sender_id_users, '$sender_username',"
        ." $receiver_id_users, '$name', '$size')";
    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
