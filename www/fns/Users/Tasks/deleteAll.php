<?php

namespace Users\Tasks;

function deleteAll ($mysqli, $user, $apiKey = null) {

    if (!$user->num_tasks) return;

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Tasks/indexOnUser.php";
    $tasks = \Tasks\indexOnUser($mysqli, $id_users);

    if ($tasks) {
        include_once __DIR__.'/../DeletedItems/addTask.php';
        foreach ($tasks as $task) {
            \Users\DeletedItems\addTask($mysqli, $task, $apiKey);
        }
    }

    include_once "$fnsDir/Tasks/deleteOnUser.php";
    \Tasks\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/TaskRevisions/setDeletedOnUser.php";
    \TaskRevisions\setDeletedOnUser($mysqli, $id_users, true);

    include_once "$fnsDir/TaskTags/deleteOnUser.php";
    \TaskTags\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/user_time_today.php";
    $time_today = user_time_today($user);
    $sql = 'update users set num_tasks = 0,'
        .' num_task_deadlines_today = 0, num_task_deadlines_tomorrow = 0,'
        ." task_deadlines_check_day = $time_today where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
