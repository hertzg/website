#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../../lib/cli.php';
include_once '../../../lib/defaults.php';
include_once '../../fns/mysqli_query_object.php';
include_once '../../lib/mysqli.php';

$microtime = microtime(true);

$sql = 'delete from bar_chart_bars'
    .' where id_users not in (select id_users from users)'
    .' or (!deleted and id_bar_charts not in (select id from bar_charts))';
$mysqli->query($sql) || trigger_error($mysqli->error);
$deleted = $mysqli->affected_rows;

$ids = [];
$sql = "select data_json from deleted_items where data_type = 'barChart'";
$rows = mysqli_query_object($mysqli, $sql);
foreach ($rows as $row) $ids[] = json_decode($row->data_json)->id;

$sql = 'select id, id_bar_charts from bar_chart_bars'
    .' where deleted and id_bar_charts not in (select id from bar_charts)';
$rows = mysqli_query_object($mysqli, $sql);
foreach ($rows as $row) {
    if (!in_array($row->id_bar_charts, $ids)) {
        $sql = "delete from bar_chart_bars where id = $row->id";
        $mysqli->query($sql) || trigger_error($mysqli->error);
        $deleted++;
    }
}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n"
    ." $deleted row(s) deleted.\n";
