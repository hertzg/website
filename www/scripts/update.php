<?php

chdir(__DIR__);
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
    'alter table users'
    .' add num_subscribed_channels tinyint not null after num_channels,'
    .' add anonymous_can_send_channel tinyint not null'
);
var_dump($mysqli->error);

$mysqli->query(
    'alter table notifications'
    .' add id_subscribed_channels bigint not null'
);
var_dump($mysqli->error);

$mysqli->query(
    'create table subscribed_channels'
    .' (id bigint unsigned primary key auto_increment not null,'
    .' id_channels bigint unsigned not null,'
    .' channel_name varchar(32) character set ascii not null,'
    .' id_users bigint unsigned not null,'
    .' username varchar(32) character set ascii collate ascii_bin not null,'
    .' subscribed_id_users bigint unsigned not null,'
    .' subscribed_username varchar(32) character set ascii collate ascii_bin not null,'
    .' insert_time bigint unsigned not null,'
    .' receive_notifications tinyint not null)'
);
var_dump($mysqli->error);

