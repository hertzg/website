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
