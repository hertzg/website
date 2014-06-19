<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$sql = 'drop table if exists deleted_folders';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'create table deleted_folders'
    .' (id bigint unsigned not null auto_increment primary key,'
    .' id_deleted_items bigint unsigned not null,'
    .' insert_time bigint unsigned not null,'
    .' name varchar(255) character set utf8 collate utf8_unicode_ci not null,'
    .' parent_id bigint unsigned not null,'
    .' rename_time bigint unsigned not null)';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'drop table if exists deleted_files';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'create table deleted_files'
    .' (id bigint unsigned not null auto_increment primary key,'
    .' id_deleted_items bigint unsigned not null,'
    .' insert_time bigint unsigned not null,'
    .' name varchar(255) character set utf8 collate utf8_unicode_ci not null,'
    .' parent_id bigint unsigned not null,'
    .' rename_time bigint unsigned not null,'
    .' size bigint unsigned not null)';
$mysqli->query($sql) || trigger_error($mysqli->error);

echo 'Done';
