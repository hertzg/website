<?php

namespace Tasks;

function setTopPriority ($mysqli, $id_users, $id, $top_priority) {
    $top_priority = $top_priority ? '1' : '0';
    $update_time = time();
    $sql = "update tasks set top_priority = $top_priority,"
        ." update_time = $update_time"
        ." where id_users = $id_users and id_tasks = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
