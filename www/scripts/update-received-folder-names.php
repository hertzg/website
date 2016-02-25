#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../../lib/defaults.php';
include_once '../fns/mysqli_query_object.php';
include_once '../fns/mysqli_single_object.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

$sql = 'select * from received_folder_files';
$received_folder_files = mysqli_query_object($mysqli, $sql);
foreach ($received_folder_files as $received_folder_file) {

    $sql = 'select * from received_folders'
        ." where id = $received_folder_file->id_received_folders";
    $received_folder = mysqli_single_object($mysqli, $sql);

    $received_folder_name = $mysqli->real_escape_string($received_folder->name);

    $sql = 'update received_folder_files set'
        ." received_folder_name = '$received_folder_name'"
        ." where id = $received_folder_file->id";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}

$sql = 'select * from received_folder_subfolders';
$received_folder_subfolders = mysqli_query_object($mysqli, $sql);
foreach ($received_folder_subfolders as $received_folder_subfolder) {

    $sql = 'select * from received_folders'
        ." where id = $received_folder_subfolder->id_received_folders";
    $received_folder = mysqli_single_object($mysqli, $sql);

    $received_folder_name = $mysqli->real_escape_string($received_folder->name);

    $sql = 'update received_folder_subfolders set'
        ." received_folder_name = '$received_folder_name'"
        ." where id = $received_folder_subfolder->id";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
