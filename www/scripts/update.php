#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../lib/mysqli.php';

include_once '../fns/Table/ensureAll.php';
echo Table\ensureAll($mysqli);

$sql = 'update files set committed = 1';
$mysqli->query($sql) || trigger_error($mysqli->error);

echo "Done\n";
