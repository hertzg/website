#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../../lib/mysqli.php';
include_once '../../../fns/mysqli_query_object.php';

$microtime = microtime(true);

$sql = 'select id from received_folder_subfolders'
    .' where id_received_folders not in (select id from received_folders)'
    .' or id_users not in (select id_users from users)'
    .' or (parent_id != 0 and parent_id not in (select id from received_folder_subfolders))';
$rows = mysqli_query_object($mysqli, $sql);
foreach ($rows as $row) {
    $sql = "delete from received_folder_subfolders where id = $row->id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n"
    .' '.count($rows)." row(s) deleted.\n";
