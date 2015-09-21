<?php

namespace Users\Schedules;

function editOrderBy ($mysqli, $id, $schedules_order_by) {
    $sql = "update users set schedules_order_by = '$schedules_order_by'"
        ." where id_users = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
