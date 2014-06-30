<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$sql = 'alter table feedbacks change id_users id_users bigint unsigned first';
$mysqli->query($sql) || trigger_error($mysqli->error);

echo "Done\n";
