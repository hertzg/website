<?php

namespace SendingBookmarks;

function add ($mysqli, $id_users, $sender_username, $receiver_username,
    $receiver_address, $url, $title, $tags) {

    $sender_username = $mysqli->real_escape_string($sender_username);
    $receiver_username = $mysqli->real_escape_string($receiver_username);
    $receiver_address = $mysqli->real_escape_string($receiver_address);
    $url = $mysqli->real_escape_string($url);
    $title = $mysqli->real_escape_string($title);
    $tags = $mysqli->real_escape_string($tags);
    $insert_time = time();

    $sql = 'insert into sending_bookmarks'
        .' (id_users, sender_username, receiver_username,'
        .' receiver_address, url, title, tags, insert_time)'
        ." values ($id_users, '$sender_username', '$receiver_username',"
        ." '$receiver_address', '$url', '$title', $tags, $insert_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
