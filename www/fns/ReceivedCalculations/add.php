<?php

namespace ReceivedCalculations;

function add ($mysqli, $sender_address, $sender_id_users,
    $sender_username, $receiver_id_users, $expression,
    $title, $tags, $value, $error, $error_char) {

    if ($sender_address === null) $sender_address = 'null';
    else $sender_address = "'".$mysqli->real_escape_string($sender_address)."'";
    if ($sender_id_users === null) $sender_id_users = 'null';
    $sender_username = $mysqli->real_escape_string($sender_username);
    $expression = $mysqli->real_escape_string($expression);
    $title = $mysqli->real_escape_string($title);
    $tags = $mysqli->real_escape_string($tags);
    if ($value === null) $value = 'null';
    if ($error === null) $error = $error_char = 'null';
    else $error = "'".$mysqli->real_escape_string($error)."'";
    $insert_time = time();

    $sql = 'insert into received_calculations'
        .' (sender_address, sender_id_users,'
        .' sender_username, receiver_id_users, expression,'
        .' title, tags, value, error, error_char, insert_time)'
        ." values ($sender_address, $sender_id_users,"
        ." '$sender_username', $receiver_id_users, '$expression',"
        ." '$title', '$tags', $value, $error, $error_char, $insert_time)";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
