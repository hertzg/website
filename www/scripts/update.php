<?php

include_once '../lib/mysqli.php';

$mysqli->query(
    'alter table events'
    .' change inserttime insert_time bigint unsigned not null,'
    .' change edittime update_time bigint unsigned not null'
);

echo 'Done';
