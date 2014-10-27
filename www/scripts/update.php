#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../lib/mysqli.php';

$sql = 'alter table bookmarks change id_bookmarks'
    .' id bigint unsigned auto_increment';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'alter table contacts change id_contacts'
    .' id bigint unsigned auto_increment';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'alter table notes change id_notes'
    .' id bigint unsigned auto_increment';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'alter table tasks change id_tasks'
    .' id bigint unsigned auto_increment';
$mysqli->query($sql) || trigger_error($mysqli->error);

echo "Done\n";
