<?php

namespace Users;

function clearNumEvents ($mysqli, $id_users) {
    include_once __DIR__.'/../../fns/time_today.php';
    $events_check_day = time_today();
    $sql = 'update users set num_events = 0, num_events_today = 0,'
        ." num_events_tomorrow = 0, events_check_day = $events_check_day"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
