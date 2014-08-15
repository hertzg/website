<?php

include_once '../../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once 'fns/require_item.php';
list($item, $key, $user) = require_item();

$order_home_items = json_decode($user->order_home_items);
$index = array_search($key, $order_home_items);
if ($index !== -1) {
    array_splice($order_home_items, $index, 1);
}
array_unshift($order_home_items, $key);
$order_home_items = json_encode($order_home_items);

include_once '../../../../fns/Users/Home/editOrder.php';
include_once '../../../../lib/mysqli.php';
Users\Home\editOrder($mysqli, $user->id_users, $order_home_items);

$message = "\"$item[title]\" has been moved to the top.";
$_SESSION['home/customize/reorder/messages'] = [$message];

include_once '../../../../fns/redirect.php';
redirect('..');
