#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../lib/mysqli.php';

$sql = "update users set theme_brightness = 'light'";
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'alter table users change theme'
    ." theme_color enum('orange','green','blue','pink')"
    .' character set ascii collate ascii_bin not null';
$mysqli->query($sql) || trigger_error($mysqli->error);

echo "Done\n";
