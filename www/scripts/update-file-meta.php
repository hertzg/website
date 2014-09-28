#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../lib/mysqli.php';
include_once '../fns/detect_content_type.php';
include_once '../fns/detect_media_type.php';
include_once '../fns/mysqli_query_object.php';

$microtime = microtime(true);

$deletedFiles = mysqli_query_object($mysqli, 'select * from deleted_files');
foreach ($deletedFiles as $deletedFile) {
    $name = $deletedFile->name;
    $content_type = detect_content_type($name);
    $media_type = detect_media_type($name);
    $sql = "update deleted_files set content_type = '$content_type',"
        ." media_type = '$media_type' where id_files = $deletedFile->id_files";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

$files = mysqli_query_object($mysqli, 'select * from files');
foreach ($files as $file) {
    $name = $file->name;
    $content_type = detect_content_type($name);
    $media_type = detect_media_type($name);
    $sql = "update files set content_type = '$content_type',"
        ." media_type = '$media_type' where id_files = $file->id_files";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

$receivedFiles = mysqli_query_object($mysqli, 'select * from received_files');
foreach ($receivedFiles as $receivedFile) {
    $name = $receivedFile->name;
    $content_type = detect_content_type($name);
    $media_type = detect_media_type($name);
    $sql = "update received_files set content_type = '$content_type',"
        ." media_type = '$media_type' where id = $receivedFile->id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

$sql = 'select * from received_folder_files';
$receivedFolderFiles = mysqli_query_object($mysqli, $sql);
foreach ($receivedFolderFiles as $receivedFolderFile) {
    $name = $receivedFolderFile->name;
    $content_type = detect_content_type($name);
    $media_type = detect_media_type($name);
    $sql = "update received_folder_files set content_type = '$content_type',"
        ." media_type = '$media_type' where id = $receivedFolderFile->id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

$sql = 'select * from deleted_items'
    ." where data_type in ('file', 'receivedFile')";
$deletedItems = mysqli_query_object($mysqli, $sql);
foreach ($deletedItems as $deletedItem) {
    $data = json_decode($deletedItem->data_json);
    $name = $data->name;
    $data->content_type = detect_content_type($name);
    $data->media_type = detect_media_type($data->name);
    $data = json_encode($data);
    $data_json = $mysqli->real_escape_string($data);
    $sql = "update deleted_items set data_json = '$data_json'"
        ." where id = $deletedItem->id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
