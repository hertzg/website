<?php

include_once '../lib/mysqli.php';

$sql = 'alter table users'
    .' add num_notifications bigint unsigned not null';
$mysqli->query($sql) || die($mysqli->error);

include_once 'update-num-items.php';

echo 'Done';
