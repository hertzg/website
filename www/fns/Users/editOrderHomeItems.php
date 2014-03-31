<?php

namespace Users;

function editOrderHomeItems ($mysqli, $id_users, $order_home_items) {
    $order_home_items = $mysqli->real_escape_string($order_home_items);
    $mysqli->query(
        "update users set order_home_items = '$order_home_items'"
        ." where id_users = $id_users"
    );
}
