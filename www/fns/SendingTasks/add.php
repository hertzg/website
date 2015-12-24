<?php

namespace SendingTasks;

function add ($mysqli, $id_users, $sender_username,
    $receiver_username, $receiver_address, $id_admin_connections,
    $their_exchange_api_key, $text, $deadline_time, $tags, $top_priority) {

    $sender_username = $mysqli->real_escape_string($sender_username);
    $receiver_username = $mysqli->real_escape_string($receiver_username);
    $receiver_address = $mysqli->real_escape_string($receiver_address);
    $text = $mysqli->real_escape_string($text);
    if ($deadline_time === null) $deadline_time = 'null';
    $tags = $mysqli->real_escape_string($tags);
    $top_priority = $top_priority ? '1' : '0';
    $insert_time = time();

    $sql = 'insert into sending_tasks'
        .' (id_users, sender_username, receiver_username,'
        .' receiver_address, id_admin_connections,'
        .' their_exchange_api_key, text, deadline_time,'
        .' tags, top_priority, insert_time)'
        ." values ($id_users, '$sender_username', '$receiver_username',"
        ." '$receiver_address', $id_admin_connections,"
        ." '$their_exchange_api_key', '$text', $deadline_time,"
        ." '$tags', $top_priority, $insert_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
