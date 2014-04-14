<?php

namespace Users;

function addNumEvents ($mysqli, $id_users, $num_events) {
    $sql = "update users set num_events = num_events + $num_events"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
