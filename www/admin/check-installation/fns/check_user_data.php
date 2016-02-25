<?php

function check_user_data ($mysqli) {

    $fnsDir = __DIR__.'/../../../fns';
    include_once __DIR__.'/assert.php';

    $content = '';

    include_once "$fnsDir/mysqli_query_object.php";
    $users = mysqli_query_object($mysqli, 'select * from users');
    if ($users) {
        include_once "$fnsDir/Files/File/dir.php";
        include_once "$fnsDir/ReceivedFiles/File/dir.php";
        include_once "$fnsDir/ReceivedFolderFiles/File/dir.php";
        foreach ($users as $user) {

            $id_users = $user->id_users;

            $content .=
                assert_writable_folder(Files\File\dir($id_users))
                .assert_writable_folder(ReceivedFiles\File\dir($id_users));

            $dir = ReceivedFolderFiles\File\dir($id_users);
            $content .= assert_writable_folder($dir);

        }
    }

    $files = mysqli_query_object($mysqli, 'select * from files');
    if ($files) {
        include_once "$fnsDir/Files/File/path.php";
        foreach ($files as $file) {
            $path = Files\File\path($file->id_users, $file->id_files);
            $content .= assert_writable_file($path);
        }
    }

    $sql = 'select * from received_files';
    $receivedFiles = mysqli_query_object($mysqli, $sql);
    if ($receivedFiles) {
        include_once "$fnsDir/ReceivedFiles/File/path.php";
        foreach ($receivedFiles as $receivedFile) {
            $receiver_id_users = $receivedFile->receiver_id_users;
            $path = ReceivedFiles\File\path(
                $receiver_id_users, $receivedFile->id);
            $content .= assert_readable_file($path);
        }
    }

    $sql = 'select * from received_folder_files';
    $receivedFolderFiles = mysqli_query_object($mysqli, $sql);
    if ($receivedFolderFiles) {
        include_once "$fnsDir/ReceivedFolderFiles/File/path.php";
        foreach ($receivedFolderFiles as $receivedFolderFile) {
            $id_users = $receivedFolderFile->id_users;
            $id = $receivedFolderFile->id;
            $path = ReceivedFolderFiles\File\path($id_users, $id);
            $content .= assert_readable_file($path);
        }
    }

    return $content;

}
