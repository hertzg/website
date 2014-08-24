#!/usr/bin/php
<?php

chdir(__DIR__);
include_once 'lib/require-cli.php';
include_once '../lib/mysqli.php';

$sql = 'alter table contact_tags'
    .' add phone1 varchar(32) not null after insert_time,'
    .' add phone2 varchar(32) not null after phone1';
$mysqli->query($sql) || trigger_error($mysqli->error);

echo "Done\n";
