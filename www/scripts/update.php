#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../lib/mysqli.php';

$sql = 'alter table notes change encrypt'
    .' encrypt_in_listings tinyint unsigned not null';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'alter table note_tags change encrypt'
    .' encrypt_in_listings tinyint unsigned not null';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'alter table received_notes change encrypt'
    .' encrypt_in_listings tinyint unsigned not null';
$mysqli->query($sql) || trigger_error($mysqli->error);

echo "Done\n";
