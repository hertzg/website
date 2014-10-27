#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../lib/mysqli.php';

$sql = 'alter table bookmarks change id_bookmarks'
    .' id bigint unsigned auto_increment';
$mysqli->query($sql) || trigger_error($mysqli->error);

echo "Done\n";
