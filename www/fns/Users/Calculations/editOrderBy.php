<?php

namespace Users\Calculations;

function editOrderBy ($mysqli, $id, $calculations_order_by) {
    $sql = "update users set calculations_order_by = '$calculations_order_by'"
        ." where id_users = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
