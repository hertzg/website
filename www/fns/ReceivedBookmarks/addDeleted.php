<?php

namespace ReceivedBookmarks;

function addDeleted ($mysqli, $id, $sender_address,
    $sender_id_users, $sender_username, $receiver_id_users,
    $url, $title, $tags, $archived, $insert_time) {

    if ($sender_address === null) $sender_address = 'null';
    else $sender_address = "'".$mysqli->real_escape_string($sender_address)."'";
    if ($sender_id_users === null) $sender_id_users = 'null';
    $sender_username = $mysqli->real_escape_string($sender_username);
    $url = $mysqli->real_escape_string($url);
    $title = $mysqli->real_escape_string($title);
    $tags = $mysqli->real_escape_string($tags);
    $archived = $archived ? '1' : '0';

    $sql = 'insert into received_bookmarks'
        .' (id, sender_address, sender_id_users,'
        .' sender_username, receiver_id_users, url,'
        .' title, tags, archived, insert_time)'
        ." values ($id, $sender_address, $sender_id_users,"
        ." '$sender_username', $receiver_id_users, '$url',"
        ." '$title', '$tags', $archived, $insert_time)";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
