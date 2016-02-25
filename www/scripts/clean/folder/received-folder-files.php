#!/usr/bin/php
<?php

function clean_user_received_folder_files ($mysqli, $id_users, &$deleted) {

    $fnsDir = '../../../fns';

    include_once "$fnsDir/ReceivedFolderFiles/File/dir.php";
    $dir = ReceivedFolderFiles\File\dir($id_users);

    if (!is_dir($dir)) return;

    $d = opendir($dir);
    while ($file = readdir($d)) {

        if ($file == '.' || $file == '..') continue;

        $id = (int)$file;

        include_once "$fnsDir/ReceivedFolderFiles/getOnUser.php";
        if (ReceivedFolderFiles\getOnUser($mysqli, $id_users, $id)) continue;

        $deleted++;
        unlink("$dir/$id");

    }
    closedir($d);

}

chdir(__DIR__);
include_once '../../../../lib/cli.php';
include_once '../../../../lib/defaults.php';
include_once '../../../lib/mysqli.php';
include_once '../../../fns/mysqli_query_object.php';
include_once '../../../fns/mysqli_single_object.php';

$microtime = microtime(true);

$deleted = 0;
include_once 'fns/for_each_user.php';
for_each_user(function ($id_users) use ($mysqli, &$deleted) {
    clean_user_received_folder_files($mysqli, $id_users, $deleted);
});

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n"
    ." $deleted file(s) deleted.\n";
