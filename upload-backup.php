#!/usr/bin/php
<?php

function curl_file ($file) {
    if (class_exists('CURLFile')) return new CURLFile($file);
    return "@$file";
}

if (count($argv) != 4) {
    echo "Usage: ./upload-backup.php <zvini_location> <api_key> <parent_id>\n";
    exit(1);
}

chdir(__DIR__);
system('./backup-code.sh');
system('./backup-data.sh');
system('./backup-sql.php');

$zvini_location = $argv[1];
$api_key = $argv[2];
$parent_id = $argv[3];

$callZviniMethod = function ($method, $params) use ($zvini_location, $api_key) {

    $params['api_key'] = $api_key;

    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => "{$zvini_location}api-call/$method",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => $params,
    ]);
    $response = curl_exec($ch);

    if ($response === false) {
        echo 'ERROR: '.curl_error($ch)."\n";
        exit(1);
    }

    if (curl_getinfo($ch, CURLINFO_HTTP_CODE) != 200) {
        echo "ERROR: $response\n";
        exit(1);
    }

    return json_decode($response);

};

$folder_id = $callZviniMethod('folder/add', [
    'parent_id' => $parent_id,
    'name' => date('Y-m-d'),
]);

$callZviniMethod('file/add', [
    'parent_id' => $folder_id,
    'file' => curl_file('backup-code.tgz'),
    'name' => 'backup-code.tgz',
]);

$callZviniMethod('file/add', [
    'parent_id' => $folder_id,
    'file' => curl_file('backup-data.tgz'),
    'name' => 'backup-data.tgz',
]);

$callZviniMethod('file/add', [
    'parent_id' => $folder_id,
    'file' => curl_file('backup-sql.tgz'),
    'name' => 'backup-sql.tgz',
]);

$files = $callZviniMethod('file/list', ['parent_id' => $folder_id]);

foreach ($files as $file) {
    if ($file->insert_time < time() - 30 * 24 * 60 * 60) {
        $callZviniMethod('file/delete', ['id' => $file->id]);
    }
}