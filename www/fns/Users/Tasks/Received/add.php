<?php

namespace Users\Tasks\Received;

function add ($mysqli, $sender_id_users, $sender_username,
    $receiver_id_users, $text, $deadline_time, $tags, $top_priority) {

    include_once __DIR__.'/../../../ReceivedTasks/add.php';
    \ReceivedTasks\add($mysqli, $sender_id_users, $sender_username,
        $receiver_id_users, $text, $deadline_time, $tags, $top_priority);

    include_once __DIR__.'/addNumberNew.php';
    addNumberNew($mysqli, $receiver_id_users, 1);

}
