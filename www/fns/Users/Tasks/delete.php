<?php

namespace Users\Tasks;

function delete ($mysqli, $task) {

    $id = $task->id_tasks;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Tasks/delete.php";
    \Tasks\delete($mysqli, $id);

    include_once "$fnsDir/TaskTags/deleteOnTask.php";
    \TaskTags\deleteOnTask($mysqli, $id);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $task->id_users, -1);

    include_once "$fnsDir/DeletedItems/Tasks/add.php";
    \DeletedItems\Tasks\add($mysqli, $task);

}
