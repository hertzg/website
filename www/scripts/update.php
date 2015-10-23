#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../lib/mysqli.php';

include_once '../fns/Table/ensureAll.php';
echo Table\ensureAll($mysqli);

$sql = 'update files set hashes_computed = 1';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'update received_files set hashes_computed = 1';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'update received_folder_files set hashes_computed = 1';
$mysqli->query($sql) || trigger_error($mysqli->error);

echo "Done\n";
