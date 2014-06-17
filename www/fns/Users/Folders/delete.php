<?php

namespace Users\Folders;

function delete ($mysqli, $id) {
    $ids = [$id];
    while ($ids) {

        $id = array_shift($ids);

        include_once __DIR__.'/../../Folders/delete.php';
        \Folders\delete($mysqli, $id);

        include_once __DIR__.'/../../Folders/indexInFolder.php';
        $folders = \Folders\indexInFolder($mysqli, $id);

        foreach ($folders as $folder) {
            $ids[] = $folder->id_folders;
        }

        include_once __DIR__.'/../../Files/indexInFolder.php';
        $files = \Files\indexInFolder($mysqli, $id);

        foreach ($files as $file) {

            include_once __DIR__.'/../Files/purge.php';
            \Users\Files\purge($mysqli, $file);

            include_once __DIR__.'/../../Files/File/delete.php';
            \Files\File\delete($file->id_users, $file->id_files);

        }

    }
}
