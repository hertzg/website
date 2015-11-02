<?php

namespace ReceivedNotes;

function addDeleted ($mysqli, $id, $sender_address,
    $sender_id_users, $sender_username, $receiver_id_users, $text,
    $title, $tags, $encrypt_in_listings, $archived, $insert_time) {

    if ($sender_address === null) $sender_address = 'null';
    else $sender_address = "'".$mysqli->real_escape_string($sender_address)."'";
    if ($sender_id_users === null) $sender_id_users = 'null';
    $sender_username = $mysqli->real_escape_string($sender_username);
    $text = $mysqli->real_escape_string($text);
    $title = $mysqli->real_escape_string($title);
    $tags = $mysqli->real_escape_string($tags);
    $encrypt_in_listings = $encrypt_in_listings ? '1' : '0';
    $archived = $archived ? '1' : '0';

    $sql = 'insert into received_notes'
        .' (id, sender_address, sender_id_users,'
        .' sender_username, receiver_id_users, text, title,'
        .' tags, encrypt_in_listings, archived, insert_time)'
        ." values ($id, $sender_address, $sender_id_users,"
        ." '$sender_username', $receiver_id_users, '$text', '$title',"
        ." '$tags', $encrypt_in_listings, $archived, $insert_time)";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
