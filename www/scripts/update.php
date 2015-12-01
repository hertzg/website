#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../lib/mysqli.php';

include_once '../fns/Table/ensureAll.php';
echo Table\ensureAll($mysqli);

$sql = "update users set calculations_order_by = 'update_time desc'";
$mysqli->query($sql) || trigger_error($mysqli->error);

include '../fns/Users/index.php';
$users = Users\index($mysqli);

foreach ($users as $user) {
    $order_home_items = json_decode($user->order_home_items);
    $include = function ($item, $before) use (&$order_home_items) {

        $index = array_search($item, $order_home_items);
        if ($index !== false) array_splice($order_home_items, $index, 1);

        $index = array_search($before, $order_home_items);
        array_splice($order_home_items, $index, 0, $item);

    };
    $include('calculations', 'calendar');
    $include('new-calculation', 'calendar');
    $order_home_items = json_encode($order_home_items);
    $order_home_items = $mysqli->real_escape_string($order_home_items);
    $sql = "update users set order_home_items = '$order_home_items',"
        ." show_calculations = 1 where id_users = $user->id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

/*
include_once '../fns/get_absolute_base.php';
$url = get_absolute_base().'scripts/ensure-crontab.php';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_exec($ch);
*/

echo "Done\n";
