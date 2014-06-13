<?php

namespace Users\Tasks\Received;

function delete ($mysqli, $receivedTask) {

    include_once __DIR__.'/../../../ReceivedTasks/delete.php';
    \ReceivedTasks\delete($mysqli, $receivedTask->id);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $receivedTask->receiver_id_users, -1);

    include_once __DIR__.'/../../DeletedItems/addReceivedTask.php';
    \Users\DeletedItems\addReceivedTask($mysqli, $receivedTask);

}
