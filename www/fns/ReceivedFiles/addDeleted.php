<?php

namespace ReceivedFiles;

function addDeleted ($mysqli, $id, $sender_id_users, $sender_username,
    $receiver_id_users, $media_type, $name, $size, $archived, $insert_time) {

    $sender_username = $mysqli->real_escape_string($sender_username);
    $name = $mysqli->real_escape_string($name);
    $archived = $archived ? '1' : '0';

    $sql = 'insert into received_files'
        .' (id, sender_id_users, sender_username,'
        .' receiver_id_users, media_type, name,'
        .' size, archived, insert_time, committed)'
        ." values ($id, $sender_id_users, '$sender_username',"
        ." $receiver_id_users, '$media_type', '$name',"
        ." '$size', $archived, $insert_time, 1)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
