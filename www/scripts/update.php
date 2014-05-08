<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$mysqli->query('alter table users'
    .' add num_connections bigint unsigned not null') || trigger_error($mysqli->error);

echo "Done\n";
