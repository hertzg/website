<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$mysqli->query(
    'create table api_keys ('
    .' id bigint unsigned primary key auto_increment not null,'
    .' id_users bigint unsigned not null,'
    .' `key` binary(32) not null,'
    .' name varchar(64) character set utf8 not null,'
    .' insert_time bigint unsigned not null)'
) || trigger_error($mysqli->error);

$mysqli->query(
    'alter table channels change receive_notifications receive_notifications tinyint not null'
) || trigger_error($mysqli->error);

echo "Done\n";
