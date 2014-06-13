<?php

namespace ReceivedTasks;

function addDeleted ($mysqli, $id, $sender_id_users, $sender_username,
    $receiver_id_users, $text, $top_priority, $tags, $archived, $insert_time) {

    $sender_username = $mysqli->real_escape_string($sender_username);
    $text = $mysqli->real_escape_string($text);
    $top_priority = $top_priority ? '1' : '0';
    $tags = $mysqli->real_escape_string($tags);
    $archived = $archived ? '1' : '0';

    $sql = 'insert into received_tasks'
        .' (id, sender_id_users, sender_username,'
        .' receiver_id_users, text, top_priority,'
        .' tags, archived, insert_time)'
        ." values ($id, $sender_id_users, '$sender_username'"
        .", $receiver_id_users, '$text', $top_priority,"
        ." '$tags', $archived, $insert_time)";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
