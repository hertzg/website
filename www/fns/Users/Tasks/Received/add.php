<?php

namespace Users\Tasks\Received;

function add ($mysqli, $sender_id_users, $sender_username,
    $receiver_id_users, $text, $top_priority, $tags) {

    include_once __DIR__.'/../../../ReceivedTasks/add.php';
    \ReceivedTasks\add($mysqli, $sender_id_users, $sender_username,
        $receiver_id_users, $text, $top_priority, $tags);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $receiver_id_users, 1);

}
