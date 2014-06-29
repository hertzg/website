<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$mysqli->query('alter table users change num_new_notifications_for_home home_num_new_notifications bigint unsigned not null after insert_time') || trigger_error($mysqli->error);

echo "Done\n";
