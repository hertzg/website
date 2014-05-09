<?php

namespace Users\Tasks;

function delete ($mysqli, $task) {

    $id = $task->id_tasks;

    include_once __DIR__.'/../../Tasks/delete.php';
    \Tasks\delete($mysqli, $id);

    include_once __DIR__.'/../../TaskTags/deleteOnTask.php';
    \TaskTags\deleteOnTask($mysqli, $id);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $task->id_users, -1);

}
