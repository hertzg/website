<?php

namespace Users;

function addNumTasks ($mysqli, $idusers, $num_tasks) {
    $sql = "update users set num_tasks = num_tasks + $num_tasks"
        ." where idusers = $idusers";
    $mysqli->query($sql);
}
