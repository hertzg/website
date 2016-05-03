#!/usr/bin/php
<?php

function clean_user_received_files ($mysqli, $id_users, &$deleted) {

    $fnsDir = '../../fns';

    include_once "$fnsDir/ReceivedFiles/File/dir.php";
    $dir = ReceivedFiles\File\dir($id_users);

    if (!is_dir($dir)) return;

    $d = opendir($dir);
    while ($file = readdir($d)) {

        if ($file == '.' || $file == '..') continue;

        $id = (int)$file;

        include_once "$fnsDir/ReceivedFiles/getOnReceiver.php";
        if (ReceivedFiles\getOnReceiver($mysqli, $id_users, $id)) continue;

        include_once "$fnsDir/DeletedItems/indexOnUserOfType.php";
        $deletedItems = DeletedItems\indexOnUserOfType(
            $mysqli, $id_users, 'receivedFile');

        $found = false;
        foreach ($deletedItems as $deletedItem) {
            $data = json_decode($deletedItem->data_json);
            if ($data->id == $id) {
                $found = true;
                break;
            }
        }

        $deleted++;
        unlink("$dir/$id");

    }
    closedir($d);

}

chdir(__DIR__);
include_once '../../../lib/cli.php';
include_once '../../../lib/defaults.php';
include_once '../../lib/mysqli.php';
include_once '../../fns/mysqli_query_object.php';
include_once '../../fns/mysqli_single_object.php';

$microtime = microtime(true);

$deleted = 0;
include_once 'fns/for_each_user.php';
for_each_user(function ($id_users) use ($mysqli, &$deleted) {
    clean_user_received_files($mysqli, $id_users, $deleted);
});

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n"
    ." $deleted file(s) deleted.\n";
