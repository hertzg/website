<?php

namespace Users\Events;

function invalidate ($mysqli, $id_users) {
    $sql = 'update users set events_check_day = 0, num_events_today = 0,'
        ." num_events_tomorrow = 0 where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
