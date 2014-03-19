<?php

chdir(__DIR__);

include_once '../lib/mysqli.php';

include_once '../fns/mysqli_query_object.php';
$users = mysqli_query_object($mysqli, 'select * from users');

foreach ($users as $user) {

    $idusers = $user->idusers;

    $dirname = "../users/$idusers";
    if (!is_dir($dirname)) {
        echo "$dirname not found\n";
        continue;
    }

    $dirname = "../users/$idusers/files";
    if (!is_dir($dirname)) mkdir($dirname);

    $files = mysqli_query_object($mysqli, "select * from files where idusers = $idusers");
    foreach ($files as $file) {
        $idfiles = $file->idfiles;
        $sourceFile = "../users/$idusers/$idfiles";
        if (is_file($sourceFile)) {
            rename($sourceFile, "../users/$idusers/files/$idfiles");
        }
    }

}

echo 'Done.';
