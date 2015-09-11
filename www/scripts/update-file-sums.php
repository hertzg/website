#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../fns/mysqli_query_object.php';
include_once '../lib/mysqli.php';

$files = mysqli_query_object($mysqli, 'select * from files');
include_once '../fns/Files/File/path.php';
foreach ($files as $file) {

    $id = $file->id_files;
    $filename = Files\File\path($file->id_users, $id);

    include_once '../fns/file_sums.php';
    file_sums($filename, $md5_sum, $sha256_sum);

    $sql = "update files set md5_sum = '$md5_sum',"
        ." sha256_sum = '$sha256_sum' where id_files = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}

$receivedFiles = mysqli_query_object($mysqli, 'select * from received_files');
include_once '../fns/ReceivedFiles/File/path.php';
foreach ($receivedFiles as $receivedFile) {

    $id = $receivedFile->id;
    $filename = ReceivedFiles\File\path($receivedFile->receiver_id_users, $id);

    include_once '../fns/file_sums.php';
    file_sums($filename, $md5_sum, $sha256_sum);

    $sql = "update received_files set md5_sum = '$md5_sum',"
        ." sha256_sum = '$sha256_sum' where id = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}

$sql = 'select * from received_folder_files';
$receivedFolderFiles = mysqli_query_object($mysqli, $sql);
include_once '../fns/ReceivedFolderFiles/File/path.php';
foreach ($receivedFolderFiles as $receivedFolderFile) {

    $id = $receivedFolderFile->id;
    $filename = ReceivedFolderFiles\File\path(
        $receivedFolderFile->id_users, $id);

    include_once '../fns/file_sums.php';
    file_sums($filename, $md5_sum, $sha256_sum);

    $sql = "update received_folder_files set md5_sum = '$md5_sum',"
        ." sha256_sum = '$sha256_sum' where id = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}

$sql = 'select * from deleted_items'
    ." where data_type in ('file', 'receivedFile')";
$deletedItems = mysqli_query_object($mysqli, $sql);
foreach ($deletedItems as $deletedItem) {

    $data_json = json_decode($deletedItem->data_json);

    $id = $data_json->id;
    if ($deletedItem->data_type == 'file') {
        $filename = Files\File\path($deletedItem->id_users, $id);
    } else {
        $filename = ReceivedFiles\File\path($deletedItem->id_users, $id);
    }

    include_once '../fns/file_sums.php';
    file_sums($filename, $md5_sum, $sha256_sum);

    $data_json->md5_sum = $md5_sum;
    $data_json->sha256_sum = $sha256_sum;
    $data_json = $mysqli->real_escape_string(json_encode($data_json));

    $sql = 'update deleted_items set'
        ." data_json = '$data_json' where id = $deletedItem->id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}

echo "Done\n";
