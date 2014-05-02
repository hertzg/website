<?php

namespace Users\Schedules;

function invalidate ($mysqli, $id_users) {
    $sql = 'update users set schedules_check_day = 0, num_schedules_today = 0,'
        ." num_schedules_tomorrow = 0 where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
