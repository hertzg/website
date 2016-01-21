<?php

namespace Users\Account\Close;

function deleteSchedules ($mysqli, $user) {

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../../..';

    if ($user->num_schedules) {

        include_once "$fnsDir/Schedules/deleteOnUser.php";
        \Schedules\deleteOnUser($mysqli, $id_users);

        include_once "$fnsDir/ScheduleTags/deleteOnUser.php";
        \ScheduleTags\deleteOnUser($mysqli, $id_users);

        include_once "$fnsDir/ScheduleRevisions/deleteOnUser.php";
        \ScheduleRevisions\deleteOnUser($mysqli, $id_users);

    }

    if ($user->num_received_schedules) {
        include_once "$fnsDir/ReceivedSchedules/deleteOnReceiver.php";
        \ReceivedSchedules\deleteOnReceiver($mysqli, $id_users);
    }

}
