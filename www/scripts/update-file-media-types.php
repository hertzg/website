#!/usr/bin/php
<?php

chdir(__DIR__);
include_once 'lib/require-cli.php';
include_once '../lib/mysqli.php';
include_once '../fns/detect_media_type.php';
include_once '../fns/mysqli_query_object.php';

$microtime = microtime(true);

$files = mysqli_query_object($mysqli, 'select * from files');
foreach ($files as $file) {
    $media_type = detect_media_type($file->name);
    $sql = "update files set media_type = '$media_type'"
        ." where id_files = $file->id_files";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

$receivedFiles = mysqli_query_object($mysqli, 'select * from received_files');
foreach ($receivedFiles as $receivedFile) {
    $media_type = detect_media_type($receivedFile->name);
    $sql = "update received_files set media_type = '$media_type'"
        ." where id = $receivedFile->id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

$sql = 'select * from received_folder_files';
$receivedFolderFiles = mysqli_query_object($mysqli, $sql);
foreach ($receivedFolderFiles as $receivedFolderFile) {
    $media_type = detect_media_type($receivedFolderFile->name);
    $sql = "update received_folder_files set media_type = '$media_type'"
        ." where id = $receivedFolderFile->id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

$sql = 'select * from deleted_items'
    ." where data_type in ('file', 'receivedFile')";
$deletedItems = mysqli_query_object($mysqli, $sql);
foreach ($deletedItems as $deletedItem) {
    $data = json_decode($deletedItem->data_json);
    $data->media_type = detect_media_type($data->name);
    $data = json_encode($data);
    $data_json = $mysqli->real_escape_string($data);
    $sql = "update deleted_items set data_json = '$data_json'"
        ." where id = $deletedItem->id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
