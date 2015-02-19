#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../fns/Users/Home/editOrder.php';
include_once '../fns/mysqli_query_object.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

$users = mysqli_query_object($mysqli, 'select * from users');
foreach ($users as $user) {

    $order_home_items = json_decode($user->order_home_items);

    $index = array_search('new-event', $order_home_items);
    if ($index !== false) array_splice($order_home_items, $index, 1);

    $index = array_search('calendar', $order_home_items);
    array_splice($order_home_items, $index + 1, 0, 'new-event');

    $order_home_items = json_encode($order_home_items);

    Users\Home\editOrder($mysqli, $user->id_users, $order_home_items);

}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
