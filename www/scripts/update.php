<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$mysqli->query('alter table contact_tags'
    .' add insert_time bigint unsigned not null,'
    .' add update_time bigint unsigned not null') || trigger_error($mysqli->error);

echo "Done\n";
