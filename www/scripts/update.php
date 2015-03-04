#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

$sql = 'alter table deleted_folders change parent_id_folders'
    .' parent_id bigint(20) unsigned not null';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'alter table folders change parent_id_folders'
    .' parent_id bigint(20) unsigned not null';
$mysqli->query($sql) || trigger_error($mysqli->error);

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
