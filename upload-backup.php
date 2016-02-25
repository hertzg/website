#!/usr/bin/php
<?php

include_once 'lib/defaults.php';

function curl_file ($file) {
    if (class_exists('CURLFile')) return new CURLFile($file);
    return "@$file";
}

$num_args = count($argv);

if ($num_args == 3) {
    $argv[] = '0';
    $num_args++;
}

if ($num_args != 4) {
    echo 'Usage: ./upload-backup.php'
        ." <zvini_location> <api_key> [<parent_id>]\n";
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

$putFile = function ($name) use ($callZviniMethod, $folder_id) {
    $f = fopen($name, 'r');
    $index = 0;
    while (!feof($f)) {

        $temp_file = sys_get_temp_dir().'/'.uniqid();
        file_put_contents($temp_file, fread($f, 1024 * 1024));

        if ($index === 0) {
            $id = $callZviniMethod('file/add', [
                'parent_id' => $folder_id,
                'file' => curl_file($temp_file),
                'name' => $name,
            ]);
        } else {
            $callZviniMethod('file/appendContent', [
                'id' => $id,
                'file' => curl_file($temp_file),
            ]);
        }

        unlink($temp_file);
        $index++;

    }
    fclose($f);
};

$putFile('backup-code.tgz');
$putFile('backup-data.tgz');
$putFile('backup-sql.tgz');

$folders = $callZviniMethod('folder/list', ['parent_id' => $parent_id]);

foreach ($folders as $folder) {
    if ($folder->insert_time < time() - 30 * 24 * 60 * 60) {
        $callZviniMethod('folder/delete', ['id' => $folder->id]);
    }
}
