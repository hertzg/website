<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';


$mysqli->query('drop table received_notes');
$mysqli->query('drop table received_tasks');

$mysqli->query(
    'create table received_notes'
    .' (id bigint unsigned not null auto_increment primary key,'
    .' sender_id_users bigint unsigned not null,'
    .' sender_username varchar(32) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,'
    .' receiver_id_users bigint unsigned not null,'
    .' text varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,'
    .' tags varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,'
    .' insert_time bigint unsigned not null)');

$mysqli->query(
    'create table received_tasks'
    .' (id bigint unsigned not null auto_increment primary key,'
    .' sender_id_users bigint unsigned not null,'
    .' sender_username varchar(32) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,'
    .' receiver_id_users bigint unsigned not null,'
    .' text varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,'
    .' tags varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,'
    .' top_priority tinyint unsigned not null,'
    .' insert_time bigint unsigned not null)');
