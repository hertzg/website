<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$mysqli->query('create table received_folders'
    .' (id bigint unsigned not null auto_increment primary key,'
    .' insert_time bigint(20) unsigned not null,'
    .' name varchar(255) character set utf8 collate utf8_unicode_ci not null,'
    .' receiver_id_users bigint unsigned not null,'
    .' sender_id_users bigint unsigned not null,'
    .' sender_username varchar(32) character set ascii collate ascii_bin not null)') || trigger_error($mysqli->error);

$mysqli->query('alter table users add num_received_folders bigint unsigned not null after num_received_files') || trigger_error($mysqli->error);

echo 'Done';
