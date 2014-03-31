<?php

namespace Tasks;

function edit ($mysqli, $id_users, $id, $task_text, $tags) {
    $task_text = $mysqli->real_escape_string($task_text);
    $tags = $mysqli->real_escape_string($tags);
    $update_time = time();
    $sql = "update tasks set task_text = '$task_text',"
        ." tags = '$tags', update_time = $update_time"
        ." where id_users = $id_users and id_tasks = $id";
    $mysqli->query($sql);
}
