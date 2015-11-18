<?php

namespace SendingSchedules;

function add ($mysqli, $id_users,
    $sender_username, $receiver_username, $receiver_address,
    $their_exchange_api_key, $text, $interval, $offset, $tags) {

    $sender_username = $mysqli->real_escape_string($sender_username);
    $receiver_username = $mysqli->real_escape_string($receiver_username);
    $receiver_address = $mysqli->real_escape_string($receiver_address);
    $text = $mysqli->real_escape_string($text);
    $tags = $mysqli->real_escape_string($tags);
    $insert_time = time();

    $sql = 'insert into sending_schedules'
        .' (id_users, sender_username, receiver_username,'
        .' receiver_address, their_exchange_api_key,'
        .' text, `interval`, offset, tags, insert_time)'
        ." values ($id_users, '$sender_username', '$receiver_username',"
        ." '$receiver_address', '$their_exchange_api_key',"
        ." '$text', $interval, $offset, $tags, $insert_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
