<?php

namespace Users\Schedules\Received;

function add ($mysqli, $sender_id_users,
    $sender_username, $receiver_id_users, $text,
    $interval, $offset, $tags, $sender_address = null) {

    include_once __DIR__.'/../../../ReceivedSchedules/add.php';
    \ReceivedSchedules\add($mysqli, $sender_address,
        $sender_id_users, $sender_username, $receiver_id_users,
        $text, $interval, $offset, $tags);

    include_once __DIR__.'/addNumberNew.php';
    addNumberNew($mysqli, $receiver_id_users, 1);

}
