<?php

namespace Users\Tasks;

function deleteAll ($mysqli, $id_users) {

    include_once __DIR__.'/../../Tasks/deleteOnUser.php';
    \Tasks\deleteOnUser($mysqli, $id_users);

    include_once __DIR__.'/../../TaskTags/deleteOnUser.php';
    \TaskTags\deleteOnUser($mysqli, $id_users);

    $sql = "update users set num_tasks = 0 where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
