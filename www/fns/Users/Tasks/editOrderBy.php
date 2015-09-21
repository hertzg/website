<?php

namespace Users\Tasks;

function editOrderBy ($mysqli, $id, $tasks_order_by) {
    $sql = "update users set tasks_order_by = '$tasks_order_by'"
        ." where id_users = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
