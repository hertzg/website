<?php

namespace ReceivedNotes;

function addDeleted ($mysqli, $id, $sender_id_users, $sender_username,
    $receiver_id_users, $text, $tags, $encrypt, $archived, $insert_time) {

    $sender_username = $mysqli->real_escape_string($sender_username);
    $text = $mysqli->real_escape_string($text);
    $tags = $mysqli->real_escape_string($tags);
    $encrypt = $encrypt ? '1' : '0';
    $archived = $archived ? '1' : '0';

    $sql = 'insert into received_notes'
        .' (id, sender_id_users, sender_username,'
        .' receiver_id_users, text, tags,'
        .' encrypt, archived, insert_time)'
        ." values ($id, $sender_id_users, '$sender_username'"
        .", $receiver_id_users, '$text', '$tags',"
        ." $encrypt, $archived, $insert_time)";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
