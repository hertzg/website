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
echo $mysqli->error;
