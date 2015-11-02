<?php

namespace ReceivedTasks;

function addDeleted ($mysqli, $id, $sender_address,
    $sender_id_users, $sender_username, $receiver_id_users, $text,
    $title, $deadline_time, $tags, $top_priority, $archived, $insert_time) {

    if ($sender_address === null) $sender_address = 'null';
    else $sender_address = "'".$mysqli->real_escape_string($sender_address)."'";
    if ($sender_id_users === null) $sender_id_users = 'null';
    $sender_username = $mysqli->real_escape_string($sender_username);
    $text = $mysqli->real_escape_string($text);
    $title = $mysqli->real_escape_string($title);
    if ($deadline_time === null) $deadline_time = 'null';
    $tags = $mysqli->real_escape_string($tags);
    $top_priority = $top_priority ? '1' : '0';
    $archived = $archived ? '1' : '0';

    $sql = 'insert into received_tasks'
        .' (id, sender_address, sender_id_users, sender_username,'
        .' receiver_id_users, text, title, deadline_time,'
        .' tags, top_priority, archived, insert_time)'
        ." values ($id, $sender_address, $sender_id_users, '$sender_username',"
        ." $receiver_id_users, '$text', '$title', $deadline_time,"
        ." '$tags', $top_priority, $archived, $insert_time)";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
