<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$mysqli->query('alter table contacts add birth_time bigint unsigned default null after phone2') || trigger_error($mysqli->error);
$mysqli->query('alter table contacts add birth_day bigint unsigned default null after birth_time') || trigger_error($mysqli->error);
$mysqli->query('alter table contacts add birth_month bigint unsigned default null after birth_day') || trigger_error($mysqli->error);
echo "Done\n";
