#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../lib/mysqli.php';

$sql = 'update api_keys set update_time = insert_time';
$mysqli->query($sql) || trigger_error($mysqli->error);

echo "Done\n";
