<?php

namespace Users\Tasks;

function delete ($mysqli, $user, $task, $apiKey = null) {

    $id = $task->id;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Tasks/delete.php";
    \Tasks\delete($mysqli, $id);

    include_once "$fnsDir/TaskRevisions/setDeletedOnTask.php";
    \TaskRevisions\setDeletedOnTask($mysqli, $id, true);

    if ($task->num_tags) {
        include_once "$fnsDir/TaskTags/deleteOnTask.php";
        \TaskTags\deleteOnTask($mysqli, $id);
    }

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $task->id_users, -1);

    include_once __DIR__.'/../DeletedItems/addTask.php';
    \Users\DeletedItems\addTask($mysqli, $task, $apiKey);

    $deadline_time = $task->deadline_time;
    if ($deadline_time !== null) {
        include_once __DIR__.'/Deadlines/invalidateIfNeeded.php';
        Deadlines\invalidateIfNeeded($mysqli, $user, $deadline_time);
    }

}
