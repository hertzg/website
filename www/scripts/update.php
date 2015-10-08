#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../fns/mysqli_query_object.php';
include_once '../lib/mysqli.php';

$sql = 'alter table contacts change email'
    .' email1 varchar(64) character set utf8 collate utf8_general_ci not null';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'alter table contact_tags change email'
    .' email1 varchar(64) character set utf8 collate utf8_general_ci not null';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'alter table received_contacts change email'
    .' email1 varchar(64) character set utf8 collate utf8_general_ci not null';
$mysqli->query($sql) || trigger_error($mysqli->error);

echo "Done\n";
