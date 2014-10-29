<?php

namespace Users\Tasks\Deadlines;

function invalidate ($mysqli, $id_users) {
    $sql = 'update users set task_deadlines_check_day = 0,'
        .' num_task_deadlines_today = 0, num_task_deadlines_tomorrow = 0'
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
