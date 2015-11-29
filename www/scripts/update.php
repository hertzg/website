#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../lib/mysqli.php';

include_once '../fns/Table/ensureAll.php';
echo Table\ensureAll($mysqli);

include_once '../fns/Users/index.php';
$users = Users\index($mysqli);

foreach ($users as $user) {
    $order_home_items = json_decode($user->order_home_items);
    $index = array_search('notifications', $order_home_items);
    array_splice($order_home_items, $index + 1, 0, 'post-notification');
    $order_home_items = $mysqli->real_escape_string(json_encode($order_home_items));
    $sql = "update users set order_home_items = '$order_home_items'"
        ." where id_users = $user->id_users";
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
