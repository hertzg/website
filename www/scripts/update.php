<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$mysqli->query('alter table api_keys add expire_time bigint unsigned') || trigger_error($mysqli->error);

echo "Done\n";
