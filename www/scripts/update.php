#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../lib/mysqli.php';

$sql = "update users set theme_brightness = 'light'";
$mysqli->query($sql) || trigger_error($mysqli->error);

echo "Done\n";
