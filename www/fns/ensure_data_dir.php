<?php

function ensure_data_dir ($mysqli) {

    include_once __DIR__.'/Users/index.php';
    $users = Users\index($mysqli);

    $mkdir = function ($dirname) {
        if (!is_dir($dirname)) mkdir($dirname);
    };

    if ($users) {
        include_once __DIR__.'/Users/Directory/path.php';
        foreach ($users as $user) {
            $userDir = Users\Directory\path($user->id_users);
            $mkdir($userDir);
            $mkdir("$userDir/files");
            $mkdir("$userDir/received-files");
            $mkdir("$userDir/received-folder-files");
        }
    }

}
