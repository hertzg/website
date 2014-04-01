<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$mysqli->query('drop table received_notes');
$mysqli->query('drop table received_tasks');

$mysqli->query(
    'create table received_bookmarks'
    .' (id bigint unsigned not null auto_increment primary key,'
    .' sender_id_users bigint unsigned not null,'
    .' sender_username varchar(32) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,'
    .' receiver_id_users bigint unsigned not null,'
    .' title varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,'
    .' url varchar(2048) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,'
    .' tags varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,'
    .' insert_time bigint(20) unsigned NOT NULL)');

$mysqli->query(
    'create table received_contacts'
    .' (id bigint unsigned not null auto_increment primary key,'
    .' sender_id_users bigint unsigned not null,'
    .' sender_username varchar(32) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,'
    .' receiver_id_users bigint unsigned not null,'
    .' full_name varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,'
    .' alias varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,'
    .' address varchar(128) NOT NULL,'
    .' email varchar(64) NOT NULL,'
    .' phone1 varchar(32) NOT NULL,'
    .' phone2 varchar(32) NOT NULL,'
    .' username varchar(32) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,'
    .' tags varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,'
    .' insert_time bigint(20) unsigned NOT NULL)');

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

$mysqli->query('alter table users add num_received_bookmarks bigint unsigned not null after num_logins') || var_dump($mysqli->error);
$mysqli->query('alter table users add num_received_contacts bigint unsigned not null after num_received_bookmarks') || var_dump($mysqli->error);
$mysqli->query('alter table users add num_received_notes bigint unsigned not null after num_received_contacts') || var_dump($mysqli->error);
$mysqli->query('alter table users add num_received_tasks bigint unsigned not null after num_received_notes') || var_dump($mysqli->error);

$mysqli->query('alter table users add anonymous_can_send_bookmark tinyint unsigned not null after order_home_items') || var_dump($mysqli->error);
$mysqli->query('alter table users add anonymous_can_send_contact tinyint unsigned not null after anonymous_can_send_channel') || var_dump($mysqli->error);
$mysqli->query('alter table users add anonymous_can_send_note tinyint unsigned not null after anonymous_can_send_contact') || var_dump($mysqli->error);
$mysqli->query('alter table users add anonymous_can_send_task tinyint unsigned not null after anonymous_can_send_note') || var_dump($mysqli->error);
$mysqli->query('alter table users change anonymous_can_send_channel anonymous_can_send_channel tinyint unsigned not null') || var_dump($mysqli->error);

$mysqli->query('alter table connections add can_send_bookmark tinyint unsigned not null after update_time') || var_dump($mysqli->error);
$mysqli->query('alter table connections add can_send_contact tinyint unsigned not null after can_send_channel') || var_dump($mysqli->error);
$mysqli->query('alter table connections add can_send_note tinyint unsigned not null after can_send_contact') || var_dump($mysqli->error);
$mysqli->query('alter table connections add can_send_task tinyint unsigned not null after can_send_note') || var_dump($mysqli->error);
$mysqli->query('alter table connections change can_send_channel can_send_channel tinyint unsigned not null') || var_dump($mysqli->error);
