<?php

include_once 'fns/require_item.php';
list($item, $key, $user) = require_item();

$order_home_items = json_decode($user->order_home_items);
$index = array_search($key, $order_home_items);
if ($index === false) {
    $order_home_items[] = $key;
} elseif ($index < count($order_home_items) - 1) {
    array_splice($order_home_items, $index, 1);
    array_splice($order_home_items, $index + 1, 0, $key);
}
$order_home_items = json_encode($order_home_items);

include_once '../../../fns/Users/editOrderHomeItems.php';
include_once '../../../lib/mysqli.php';
Users\editOrderHomeItems($mysqli, $user->idusers, $order_home_items);

include_once '../../../fns/redirect.php';
redirect('..');
