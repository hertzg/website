<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$mysqli->query('alter table api_keys add access_time bigint unsigned first');
echo 'Done';
