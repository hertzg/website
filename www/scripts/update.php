<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$mysqli->query('create table deleted_items'
    .' (data_json text not null,'
    .' data_type varchar(32) not null,'
    .' id bigint unsigned not null auto_increment primary key,'
    .' id_users bigint unsigned not null,'
    .' insert_time bigint unsigned not null)') || trigger_error($mysqli->error);

$mysqli->query('alter table users'
    .' add show_trash tinyint not null default 1 after show_tasks') || trigger_error($mysqli->error);

include_once '../fns/mysqli_query_object.php';
$users = mysqli_query_object($mysqli, 'select * from users');

foreach ($users as $user) {
    $order_home_items = json_decode($user->order_home_items);
    $order_home_items[] = 'trash';
    $order_home_items = json_encode($order_home_items);
    $order_home_items = $mysqli->real_escape_string($order_home_items);
    $sql = "update users set order_home_items = '$order_home_items'"
        ." where id_users = $user->id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

echo 'Done';
