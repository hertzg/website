<?php

include_once '../lib/mysqli.php';

$mysqli->query(
    'create table connections'
    .' (id_connections bigint unsigned unsigned primary key auto_increment not null,'
    .' id_users bigint unsigned not null,'
    .' connected_id_users bigint unsigned not null,'
    .' username varchar(32) character set ascii collate ascii_bin not null,'
    .' insert_time bigint unsigned not null,'
    .' update_time bigint unsigned not null)'
);
echo $mysqli->error;

$mysqli->query(
    'alter table connections add can_subscribe_to_my_channel tinyint not null'
);
echo $mysqli->error;

$mysqli->query(
    'alter table connections change id_connections id bigint unsigned unsigned auto_increment not null'
);
echo $mysqli->error;
