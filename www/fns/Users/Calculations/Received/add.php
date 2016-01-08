<?php

namespace Users\Calculations\Received;

function add ($mysqli, $sender_id_users,
    $sender_username, $receiver_id_users, $expression,
    $title, $tags, $value, $error, $error_char, $sender_address = null) {

    include_once __DIR__.'/../../../ReceivedCalculations/add.php';
    \ReceivedCalculations\add($mysqli, $sender_address,
        $sender_id_users, $sender_username, $receiver_id_users,
        $expression, $title, $tags, $value);

    $sql = 'update users set'
        .' num_received_calculations = num_received_calculations + 1,'
        .' home_num_new_received_calculations'
        .' = home_num_new_received_calculations + 1'
        ." where id_users = $receiver_id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
