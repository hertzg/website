#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../../lib/defaults.php';
include_once '../lib/mysqli.php';
include_once '../fns/mysqli_query_object.php';
include_once '../fns/mysqli_single_object.php';

include_once '../fns/MysqlConfig/get.php';
MysqlConfig\get($host, $username, $password, $db);

$db = $mysqli->real_escape_string($db);

$sql = 'select * from information_schema.tables'
    ." where table_schema = '$db' order by table_name";
$tables = mysqli_query_object($mysqli, $sql);

foreach ($tables as $table) {

    $name = $table->TABLE_NAME;

    $sql = 'select count(*) num_rows'
        .' from `'.$mysqli->real_escape_string($name).'`';
    $num_rows = mysqli_single_object($mysqli, $sql)->num_rows;

    echo str_pad($name, 30, ' ')." $num_rows\n";
}
