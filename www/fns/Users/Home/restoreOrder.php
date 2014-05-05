<?php

namespace Users\Home;

function restoreOrder ($mysqli, $id_users) {
    include_once __DIR__.'/defaultOrder.php';
    $order_home_items = defaultOrder();
    $order_home_items = json_encode($order_home_items);
    $order_home_items = $mysqli->real_escape_string($order_home_items);
    $sql = "update users set order_home_items = '$order_home_items'"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
