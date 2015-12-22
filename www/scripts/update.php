#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../lib/mysqli.php';

include_once '../fns/Table/ensureAll.php';
echo Table\ensureAll($mysqli);

$sql = "update users set theme_color = 'lime' where theme_color = ''";
$mysqli->query($sql) || trigger_error($mysqli->error);

echo "Done\n";
