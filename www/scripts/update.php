#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../fns/mysqli_query_object.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

$sql = 'update users set show_places = 1';
$mysqli->query($sql) || trigger_error($mysqli->error);

$users = mysqli_query_object($mysqli, 'select * from users');
foreach ($users as $user) {

    $order_home_items = json_decode($user->order_home_items);

    $index = array_search('places', $order_home_items);
    if ($index !== false) array_splice($order_home_items, $index, 1);

    $index = array_search('new-place', $order_home_items);
    if ($index !== false) array_splice($order_home_items, $index, 1);

    $index = array_search('notes', $order_home_items);
    array_splice($order_home_items, $index, 0, ['places', 'new-place']);

    $order_home_items = json_encode($order_home_items);
    $order_home_items = $mysqli->real_escape_string($order_home_items);

    $sql = "update users set order_home_items = '$order_home_items'"
        ." where id_users = $user->id_users";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
