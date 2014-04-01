<?php

namespace ReceivedBookmarks;

function add ($mysqli, $sender_id_users, $sender_username,
    $receiver_id_users, $url, $title, $tags) {

    $sender_username = $mysqli->real_escape_string($sender_username);
    $url = $mysqli->real_escape_string($url);
    $title = $mysqli->real_escape_string($title);
    $tags = $mysqli->real_escape_string($tags);
    $insert_time = time();

    $sql = 'insert into received_bookmarks'
        .' (sender_id_users, sender_username, receiver_id_users,'
        .' url, title, tags, insert_time)'
        ." values ($sender_id_users, '$sender_username', $receiver_id_users,"
        ." '$url', '$title', '$tags', $insert_time)";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
