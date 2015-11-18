<?php

namespace Users\Schedules\Received;

function deleteAll ($mysqli, $user, $apiKey = null) {

    if (!$user->num_received_schedules) return;

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/ReceivedSchedules/indexOnReceiver.php";
    $receivedSchedules = \ReceivedSchedules\indexOnReceiver($mysqli, $id_users);

    if ($receivedSchedules) {
        include_once __DIR__.'/../../DeletedItems/addReceivedSchedule.php';
        foreach ($receivedSchedules as $receivedSchedule) {
            \Users\DeletedItems\addReceivedSchedule(
                $mysqli, $receivedSchedule, $apiKey);
        }
    }

    include_once "$fnsDir/ReceivedSchedules/deleteOnReceiver.php";
    \ReceivedSchedules\deleteOnReceiver($mysqli, $id_users);

    $sql = 'update users set num_received_schedules = 0,'
        .' num_archived_received_schedules = 0'
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
