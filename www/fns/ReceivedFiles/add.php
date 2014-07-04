<?php

namespace ReceivedFiles;

function add ($mysqli, $sender_id_users,
    $sender_username, $receiver_id_users, $name, $size) {

    include_once __DIR__.'/../detect_media_type.php';
    $media_type = \detect_media_type($name);

    $sender_username = $mysqli->real_escape_string($sender_username);
    $name = $mysqli->real_escape_string($name);

    $sql = 'insert into received_files'
        .' (sender_id_users, sender_username,'
        .' receiver_id_users, media_type, name, size)'
        ." values ($sender_id_users, '$sender_username',"
        ." $receiver_id_users, '$media_type', '$name', '$size')";
    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
