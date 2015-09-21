<?php

namespace Users\Events;

function editOrderBy ($mysqli, $id, $events_order_by) {
    $sql = "update users set events_order_by = '$events_order_by'"
        ." where id_users = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
