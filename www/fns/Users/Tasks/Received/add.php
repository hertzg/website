<?php

namespace Users\Tasks\Received;

function add ($mysqli, $sender_id_users, $sender_username,
    $receiver_id_users, $text, $deadline_time, $tags,
    $top_priority, $sender_address = null) {

    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/Tasks/maxLengths.php";
    include_once "$fnsDir/text_title.php";
    $title = text_title($text, \Tasks\maxLengths()['title']);

    include_once "$fnsDir/ReceivedTasks/add.php";
    \ReceivedTasks\add($mysqli, $sender_address,
        $sender_id_users, $sender_username, $receiver_id_users,
        $text, $title, $deadline_time, $tags, $top_priority);

    $sql = 'update users set num_received_tasks = num_received_tasks + 1,'
        .' home_num_new_received_tasks = home_num_new_received_tasks + 1'
        ." where id_users = $receiver_id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
