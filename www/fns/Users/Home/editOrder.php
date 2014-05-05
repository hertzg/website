<?php

namespace Users\Home;

function editOrder ($mysqli, $id_users, $order_home_items) {
    $order_home_items = $mysqli->real_escape_string($order_home_items);
    $sql = "update users set order_home_items = '$order_home_items'"
        ." where id_users = $id_users";
    $mysqli->query($sql);
}
