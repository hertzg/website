<?php

include_once 'fns/require_item.php';
list($item, $key, $user) = require_item();

$order_home_items = json_decode($user->order_home_items);
$index = array_search($key, $order_home_items);
if ($index !== -1) {
    array_splice($order_home_items, $index, 1);
}
array_unshift($order_home_items, $key);
$order_home_items = json_encode($order_home_items);

include_once '../../../fns/Users/editOrderHomeItems.php';
include_once '../../../lib/mysqli.php';
Users\editOrderHomeItems($mysqli, $user->idusers, $order_home_items);

$_SESSION['customize-home/reorder/index_messages'] = array(
    "\"$item[title]\" has been moved to the top.",
);

include_once '../../../fns/redirect.php';
redirect('..');
