#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../../../lib/cli.php';
include_once '../../../../lib/defaults.php';
include_once '../../../lib/mysqli.php';
include_once '../../../fns/mysqli_query_object.php';

$microtime = microtime(true);

$sql = 'select id_folders from folders'
    .' where id_users not in (select id_users from users)'
    .' or (parent_id != 0'
    .' and parent_id not in (select id_folders from folders))';
$rows = mysqli_query_object($mysqli, $sql);
foreach ($rows as $row) {
    $sql = "delete from folders where id_folders = $row->id_folders";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n"
    .' '.count($rows)." row(s) deleted.\n";
