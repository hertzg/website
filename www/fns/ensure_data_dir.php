<?php

function ensure_data_dir ($mysqli) {

    include_once __DIR__.'/Users/index.php';
    $users = Users\index($mysqli);

    $mkdir = function ($dirname) {
        if (!is_dir($dirname)) mkdir($dirname);
    };

    include_once __DIR__.'/get_data_dir.php';
    $data_dir = get_data_dir();
    $mkdir($data_dir);
    file_put_contents("$data_dir/.htaccess", "Deny from all\n");

    include_once __DIR__.'/Users/Directory/dir.php';
    $mkdir(Users\Directory\dir());

    include_once __DIR__.'/ContactPhotos/dir.php';
    $mkdir(ContactPhotos\dir());

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
