<?php

namespace Users\Tasks\Received;

function deleteAll ($mysqli, $id_users, $apiKey = null) {

    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/ReceivedTasks/indexOnReceiver.php";
    $receivedTasks = \ReceivedTasks\indexOnReceiver($mysqli, $id_users);

    if ($receivedTasks) {
        include_once __DIR__.'/../../DeletedItems/addReceivedTask.php';
        foreach ($receivedTasks as $receivedTask) {
            \Users\DeletedItems\addReceivedTask(
                $mysqli, $receivedTask, $apiKey);
        }
    }

    include_once "$fnsDir/ReceivedTasks/deleteOnReceiver.php";
    \ReceivedTasks\deleteOnReceiver($mysqli, $id_users);

    $sql = 'update users set num_received_tasks = 0,'
        .' num_archived_received_tasks = 0'
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
