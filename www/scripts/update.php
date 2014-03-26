<?php

include_once '../lib/mysqli.php';

$mysqli->query(
    'create table connections'
    .' (id bigint unsigned unsigned primary key auto_increment not null,'
    .' id_users bigint unsigned not null,'
    .' connected_id_users bigint unsigned not null,'
    .' username varchar(32) character set ascii collate ascii_bin not null,'
    .' insert_time bigint unsigned not null,'
    .' update_time bigint unsigned not null,'
    .' can_send_channel tinyint not null)'
);
var_dump($mysqli->error);

$mysqli->query(
    'alter table users add anonymous_can_send_channel tinyint'
);
var_dump($mysqli->error);

$mysqli->query(
    'create table channel_users'
    .' (id bigint unsigned primary key auto_increment not null,'
    .' id_channels bigint unsigned not null,'
    .' id_users bigint unsigned not null,'
    .' subscribed_id_users bigint unsigned not null,'
    .' username varchar(32) character set ascii collate ascii_bin not null,'
    .' insert_time bigint unsigned not null)'
);
var_dump($mysqli->error);

