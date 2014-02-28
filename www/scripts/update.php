<?php

include_once '../lib/mysqli.php';

$sql = 'alter table channels'
    .' change numnotifications num_notifications bigint unsigned not null';
$mysqli->query($sql) || die($mysqli->error);

$sql = 'alter table users'
    .' change numnotifications num_new_notifications bigint unsigned not null';
$mysqli->query($sql) || die($mysqli->error);

echo 'Done';
