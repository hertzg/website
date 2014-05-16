<?php

namespace Users\Events;

function setNumbers ($mysqli, $id_users, $num_events_today,
    $num_events_tomorrow, $events_check_day) {

    $sql = "update users set num_events_today = $num_events_today,"
        ." num_events_tomorrow = $num_events_tomorrow,"
        ." events_check_day = $events_check_day"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
