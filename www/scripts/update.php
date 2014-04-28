<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$mysqli->query('alter table channels add update_time bigint unsigned not null');
$mysqli->query('update channels set update_time = insert_time');
