<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$mysqli->query('alter table channels add receive_notifications tinyint unsigned default 1 not null') || trigger_error($mysqli->error);
echo 'Done';
