<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$mysqli->query(
    'create table schedules'
    .' (id bigint unsigned not null auto_increment primary key,'
    .' id_users bigint unsigned not null,'
    .' text varchar(1024) character set utf8 collate utf8_unicode_ci,'
    .' day_interval bigint unsigned not null,'
    .' day_offset bigint unsigned not null,'
    .' insert_time bigint unsigned not null,'
    .' update_time bigint unsigned not null)'
);

$mysqli->query('alter table users add show_schedules tinyint unsigned not null default 1 after show_notifications');
$mysqli->query('alter table users add num_schedules bigint unsigned not null after num_notifications');

include_once '../fns/mysqli_query_object.php';
$users = mysqli_query_object($mysqli, 'select * from users');
foreach ($users as $user) {
    $order_home_items = json_decode($user->order_home_items);
    $index = array_search('notifications', $order_home_items);
    array_splice($order_home_items, $index, 0, 'schedules');
    $order_home_items = json_encode($order_home_items);
    $order_home_items = $mysqli->real_escape_string($order_home_items);
    $mysqli->query("update users set order_home_items = '$order_home_items' where id_users = $user->id_users");
}
