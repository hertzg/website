#!/usr/bin/php
<?php

function clean_user_files ($mysqli, $id_users, &$deleted) {

    include_once '../../../fns/Files/File/dir.php';
    $dir = Files\File\dir($id_users);

    if (!is_dir($dir)) return;

    $d = opendir($dir);
    while ($file = readdir($d)) {

        if ($file == '.' || $file == '..') continue;

        $id_files = (int)$file;

        $sql = "select * from files where id_files = $id_files";
        if (mysqli_single_object($mysqli, $sql)) continue;

        $sql = "select * from deleted_files where id_files = $id_files";
        if (mysqli_single_object($mysqli, $sql)) continue;

        $sql = "select * from deleted_items where data_type = 'file'";
        $deletedItems = mysqli_query_object($mysqli, $sql);

        $found = false;
        foreach ($deletedItems as $deletedItem) {
            $data = json_decode($deletedItem->data_json);
            if ($data->id == $id_files) {
                $found = true;
                break;
            }
        }

        $deleted++;
        unlink("$dir/$id_files");

    }
    closedir($d);

}

chdir(__DIR__);
include_once '../../../lib/mysqli.php';
include_once '../../../fns/mysqli_query_object.php';
include_once '../../../fns/mysqli_single_object.php';

$microtime = microtime(true);

$deleted = 0;
include_once 'fns/for_each_user.php';
for_each_user(function ($id_users) use ($mysqli, &$deleted) {
    clean_user_files($mysqli, $id_users, $deleted);
});

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n"
    ."$deleted file(s) deleted.\n";
