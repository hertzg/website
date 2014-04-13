<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$mysqli->query('alter table connections add can_send_file tinyint unsigned not null after can_send_contact') || trigger_error($mysqli->error);
$mysqli->query('alter table users add anonymous_can_send_file tinyint unsigned not null after anonymous_can_send_contact') || trigger_error($mysqli->error);
$mysqli->query('alter table users add num_received_files bigint unsigned not null after num_received_contacts') || trigger_error($mysqli->error);
$mysqli->query('create table received_files (
    id bigint unsigned primary key auto_increment not null,
    sender_id_users bigint unsigned not null,
    sender_username varchar(32) character set ascii collate ascii_bin not null,
    receiver_id_users bigint unsigned not null,
    file_name varchar(255) character set utf8 collate utf8_unicode_ci not null,
    file_size bigint unsigned not null,
    insert_time bigint unsigned not null)') || trigger_error($mysqli->error);

include_once '../fns/mysqli_query_object.php';
$users = mysqli_query_object($mysqli, 'select * from users');
foreach ($users as $user) {
    mkdir("../users/$user->id_users");
    mkdir("../users/$user->id_users/files");
    mkdir("../users/$user->id_users/received-files");
}

echo 'Done';
