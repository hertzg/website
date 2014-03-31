<?php

namespace Folders;

function delete ($mysqli, $id_users, $id_folders) {

    include_once __DIR__.'/../Files/delete.php';
    include_once __DIR__.'/../Files/indexInUserFolder.php';

    $id_folderss = [$id_folders];
    while ($id_folderss) {

        $id_folders = array_shift($id_folderss);
        $mysqli->query("delete from folders where id_folders = $id_folders");

        include_once __DIR__.'/indexInUserFolder.php';
        foreach (indexInUserFolder($mysqli, $id_users, $id_folders) as $folder) {
            $id_folderss[] = $folder->id_folders;
        }

        foreach (\Files\indexInUserFolder($mysqli, $id_users, $id_folders) as $file) {
            if (!in_array($file->id_folders, $id_folderss)) {
                $id_folderss[] = $id_folders;
            }
            \Files\delete($mysqli, $id_users, $file->id_files);
        }

    }

}
