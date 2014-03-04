<?php

include_once '../lib/mysqli.php';

$mysqli->query(
    'alter table contacts'
    .' add insert_time bigint unsigned not null,'
    .' add update_time bigint unsigned not null'
);

$insert_time = $update_time = time();
$mysqli->query(
    "update contacts set insert_time = $insert_time,"
    ." update_time = $update_time"
);

echo 'Done';
