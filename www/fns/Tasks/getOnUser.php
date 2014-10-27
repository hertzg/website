<?php

namespace Tasks;

function getOnUser ($mysqli, $id_users, $id) {
    $sql = "select * from tasks where id = $id";
    include_once __DIR__.'/../mysqli_query_object.php';
    $task = mysqli_single_object($mysqli, $sql);
    if ($task && $task->id_users == $id_users) return $task;
}
