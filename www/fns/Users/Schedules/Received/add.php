<?php

namespace Users\Schedules\Received;

function add ($mysqli, $sender_id_users,
    $sender_username, $receiver_id_users, $text,
    $interval, $offset, $tags, $sender_address = null) {

    include_once __DIR__.'/../../../ReceivedSchedules/add.php';
    \ReceivedSchedules\add($mysqli, $sender_address,
        $sender_id_users, $sender_username, $receiver_id_users,
        $text, $interval, $offset, $tags);

    $sql = 'update users set'
        .' num_received_schedules = num_received_schedules + 1,'
        .' home_num_new_received_schedules'
        .' = home_num_new_received_schedules + 1'
        ." where id_users = $receiver_id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
