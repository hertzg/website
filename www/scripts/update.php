<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$mysqli->query('create table deleted_items'
    .' (date_json text not null,'
    .' data_type varchar(32) not null,'
    .' id bigint unsigned not null,'
    .' id_users bigint unsigned not null,'
    .' insert_time bigint unsigned not null)') || trigger_error($mysqli->error);

echo 'Done';
