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

    include_once __DIR__.'/addNumberNew.php';
    addNumberNew($mysqli, $receiver_id_users, 1);

}
