<?php

include_once '../lib/mysqli.php';

$sql = 'alter table users change lastlogintime last_login_time bigint unsigned not null';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'alter table users change inserttime insert_time bigint unsigned not null';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'alter table users change storageused storage_used bigint unsigned not null';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'alter table users change fullname full_name varchar(64) character set utf8 collate utf8_unicode_ci not null';
$mysqli->query($sql) || trigger_error($mysqli->error);
