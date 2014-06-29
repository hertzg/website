<?php

namespace ReceivedTasks;

function add ($mysqli, $sender_id_users, $sender_username,
    $receiver_id_users, $text, $tags, $top_priority) {

    $sender_username = $mysqli->real_escape_string($sender_username);
    $text = $mysqli->real_escape_string($text);
    $tags = $mysqli->real_escape_string($tags);
    $top_priority = $top_priority ? '1' : '0';
    $insert_time = time();

    $sql = 'insert into received_tasks'
        .' (sender_id_users, sender_username,'
        .' receiver_id_users, text, tags, top_priority, insert_time)'
        ." values ($sender_id_users, '$sender_username'"
        .", $receiver_id_users, '$text', '$tags', $top_priority, $insert_time)";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
