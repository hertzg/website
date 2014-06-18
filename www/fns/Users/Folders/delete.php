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

        if ($files) {
            include_once __DIR__.'/../Files/purge.php';
            include_once __DIR__.'/../../Files/File/delete.php';
            foreach ($files as $file) {
                \Users\Files\purge($mysqli, $file);
                \Files\File\delete($file->id_users, $file->id_files);
            }
        }

    }
}
