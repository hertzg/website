<?php

namespace Users\Tasks\Received;

function deleteAll ($mysqli, $id_users) {

    include_once __DIR__.'/../../../ReceivedTasks/deleteOnReceiver.php';
    \ReceivedTasks\deleteOnReceiver($mysqli, $id_users);

    $sql = 'update users set num_received_tasks = 0'
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
