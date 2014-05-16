<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$mysqli->query('alter table files add rename_time bigint unsigned not null');
$mysqli->query('alter table folders add rename_time bigint unsigned not null');
$mysqli->query('update files set rename_time = insert_time');
$mysqli->query('update folders set rename_time = insert_time');
