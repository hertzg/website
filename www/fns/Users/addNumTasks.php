<?php

namespace Users;

function addNumTasks ($mysqli, $id_users, $num_tasks) {
    $sql = "update users set num_tasks = num_tasks + $num_tasks"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
