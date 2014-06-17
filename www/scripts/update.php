<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$mysqli->query('alter table users add num_deleted_items bigint unsigned not null after num_contacts') || trigger_error($mysqli->error);

echo 'Done';
