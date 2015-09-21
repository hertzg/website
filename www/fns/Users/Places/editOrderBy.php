<?php

namespace Users\Places;

function editOrderBy ($mysqli, $id, $places_order_by) {
    $sql = "update users set places_order_by = '$places_order_by'"
        ." where id_users = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
