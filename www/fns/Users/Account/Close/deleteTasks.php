<?php

namespace Users\Account\Close;

function deleteTasks ($mysqli, $user) {

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../../..';

    if ($user->num_tasks) {

        include_once "$fnsDir/Tasks/deleteOnUser.php";
        \Tasks\deleteOnUser($mysqli, $id_users);

        include_once "$fnsDir/TaskTags/deleteOnUser.php";
        \TaskTags\deleteOnUser($mysqli, $id_users);

        include_once "$fnsDir/TaskRevisions/deleteOnUser.php";
        \TaskRevisions\deleteOnUser($mysqli, $id_users);

    }

    if ($user->num_received_tasks) {
        include_once "$fnsDir/ReceivedTasks/deleteOnReceiver.php";
        \ReceivedTasks\deleteOnReceiver($mysqli, $id_users);
    }

}
