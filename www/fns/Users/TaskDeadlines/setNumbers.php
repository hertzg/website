<?php

namespace Users\TaskDeadlines;

function setNumbers ($mysqli, $id_users, $num_task_deadlines_today,
    $num_task_deadlines_tomorrow, $task_deadlines_check_day) {

    $sql = 'update users set'
        ." num_task_deadlines_today = $num_task_deadlines_today,"
        ." num_task_deadlines_tomorrow = $num_task_deadlines_tomorrow,"
        ." task_deadlines_check_day = $task_deadlines_check_day"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
