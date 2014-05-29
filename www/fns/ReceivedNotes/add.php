<?php

namespace ReceivedNotes;

function add ($mysqli, $sender_id_users, $sender_username,
    $receiver_id_users, $text, $tags, $encrypt) {

    $sender_username = $mysqli->real_escape_string($sender_username);
    $text = $mysqli->real_escape_string($text);
    $tags = $mysqli->real_escape_string($tags);
    $encrypt = $encrypt ? '1' : '0';
    $insert_time = time();

    $sql = 'insert into received_notes'
        .' (sender_id_users, sender_username,'
        .' receiver_id_users, text, tags, encrypt, insert_time)'
        ." values ($sender_id_users, '$sender_username'"
        .", $receiver_id_users, '$text', '$tags', $encrypt, $insert_time)";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
