<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$mysqli->query('alter table users add num_events_today bigint unsigned not null');
$mysqli->query('alter table users add num_events_tomorrow bigint unsigned not null');
$mysqli->query('alter table users add events_check_day bigint unsigned not null');

echo 'Done';
