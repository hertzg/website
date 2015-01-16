#!/usr/bin/php
<?php

function sort_columns ($mysqli, $table, $db) {

    $escapedTable = $mysqli->real_escape_string($table);
    $escapedDb = $mysqli->real_escape_string($db);

    $sql = 'select * from information_schema.columns'
        ." where table_schema = '$escapedDb' and table_name = '$escapedTable'"
        .' order by ordinal_position';

    $columns = mysqli_query_object($mysqli, $sql);

    usort($columns, function ($a, $b) {
        return strcmp($a->COLUMN_NAME, $b->COLUMN_NAME);
    });

    foreach ($columns as $i => $column) {

        $name = $mysqli->real_escape_string($column->COLUMN_NAME);

        $sql = "alter table `$escapedTable`"
            ." modify `$name` $column->COLUMN_TYPE ";

        if ($i) $sql .= "after `$previousName`";
        else $sql .= 'first';

        echo "$sql\n";

        $mysqli->query($sql) || trigger_error($mysqli->error);

        $previousName = $name;

    }

}

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../fns/mysqli_query_object.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

include_once '../fns/MysqlConfig/get.php';
MysqlConfig\get($host, $username, $password, $db);

$escapedDb = $mysqli->real_escape_string($db);
$sql = 'select * from information_schema.tables'
    ." where table_schema = '$escapedDb' order by table_name";
$tables = mysqli_query_object($mysqli, $sql);

foreach ($tables as $table) sort_columns($mysqli, $table->TABLE_NAME, $db);

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
