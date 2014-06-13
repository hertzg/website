<?php

namespace Users\Tasks;

function deleteAll ($mysqli, $id_users) {

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Tasks/indexOnUser.php";
    $tasks = \Tasks\indexOnUser($mysqli, $id_users);

    if ($tasks) {
        include_once __DIR__.'/../DeletedItems/addTask.php';
        foreach ($tasks as $task) {
            \Users\DeletedItems\addTask($mysqli, $task);
        }
    }

    include_once "$fnsDir/Tasks/deleteOnUser.php";
    \Tasks\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/TaskTags/deleteOnUser.php";
    \TaskTags\deleteOnUser($mysqli, $id_users);

    $sql = "update users set num_tasks = 0 where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
