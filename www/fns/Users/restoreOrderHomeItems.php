<?php

namespace Users;

function restoreOrderHomeItems ($mysqli, $idusers) {
    include_once __DIR__.'/../get_default_order_home_items.php';
    $order_home_items = get_default_order_home_items();
    $order_home_items = json_encode($order_home_items);
    $order_home_items = $mysqli->real_escape_string($order_home_items);
    $sql = "update users set order_home_items = '$order_home_items'"
        ." where idusers = $idusers";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
