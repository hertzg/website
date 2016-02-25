#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../../lib/defaults.php';
include_once '../fns/mysqli_query_object.php';
include_once '../lib/mysqli.php';

$deletedFiles = mysqli_query_object($mysqli, 'select * from deleted_files');
include_once '../fns/DeletedFiles/ensureSums.php';
foreach ($deletedFiles as $deletedFile) {
    DeletedFiles\ensureSums($mysqli, $deletedFile);
}

$files = mysqli_query_object($mysqli, 'select * from files');
include_once '../fns/Files/ensureSums.php';
foreach ($files as $file) {
    Files\ensureSums($mysqli, $file);
}

$receivedFiles = mysqli_query_object($mysqli, 'select * from received_files');
include_once '../fns/ReceivedFiles/ensureSums.php';
foreach ($receivedFiles as $receivedFile) {
    ReceivedFiles\ensureSums($mysqli, $receivedFile);
}

$sql = 'select * from received_folder_files';
$receivedFolderFiles = mysqli_query_object($mysqli, $sql);
include_once '../fns/ReceivedFolderFiles/ensureSums.php';
foreach ($receivedFolderFiles as $receivedFolderFile) {
    ReceivedFolderFiles\ensureSums($mysqli, $receivedFolderFile);
}

$sql = "select * from deleted_items where data_type = 'file'";
$deletedItems = mysqli_query_object($mysqli, $sql);
include_once '../fns/DeletedItems/ensureFileSums.php';
foreach ($deletedItems as $deletedItem) {
    DeletedItems\ensureFileSums($mysqli, $deletedItem);
}

$sql = "select * from deleted_items where data_type = 'receivedFile'";
$deletedItems = mysqli_query_object($mysqli, $sql);
include_once '../fns/DeletedItems/ensureReceivedFileSums.php';
foreach ($deletedItems as $deletedItem) {
    DeletedItems\ensureReceivedFileSums($mysqli, $deletedItem);
}

echo "Done\n";
