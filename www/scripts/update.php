<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$mysqli->query('alter table received_contacts add birthday_time bigint unsigned default null after phone2') || trigger_error($mysqli->error);
echo "Done\n";
