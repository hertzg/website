<?php

namespace ReceivedNotes;

function add ($mysqli, $sender_id_users, $sender_username,
    $receiver_id_users, $text, $title, $tags, $encrypt_in_listings) {

    $sender_username = $mysqli->real_escape_string($sender_username);
    $text = $mysqli->real_escape_string($text);
    $title = $mysqli->real_escape_string($title);
    $tags = $mysqli->real_escape_string($tags);
    $encrypt_in_listings = $encrypt_in_listings ? '1' : '0';
    $insert_time = time();

    $sql = 'insert into received_notes'
        .' (sender_id_users, sender_username, receiver_id_users,'
        .' text, title, tags, encrypt_in_listings, insert_time)'
        ." values ($sender_id_users, '$sender_username', $receiver_id_users,"
        ." '$text', '$title', '$tags', $encrypt_in_listings, $insert_time)";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
