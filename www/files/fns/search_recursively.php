<?php

function search_recursively ($mysqli, $id_users, $parent_id_folders, $keyword) {

    include_once __DIR__.'/../../fns/Files/searchInFolder.php';
    $files = Files\searchInFolder($mysqli, $id_users, $parent_id_folders, $keyword);

    include_once __DIR__.'/../../fns/Folders/searchInFolder.php';
    $folders = Folders\searchInFolder($mysqli, $id_users, $parent_id_folders, $keyword);

    include_once __DIR__.'/../../fns/Folders/indexInUserFolder.php';
    foreach (Folders\indexInUserFolder($mysqli, $id_users, $parent_id_folders) as $folder) {
        list($subfolders, $subfiles) = search_recursively($mysqli, $id_users,
            $folder->id_folders, $keyword);
        $folders = array_merge($folders, $subfolders);
        $files = array_merge($files, $subfiles);
    }
    return [$folders, $files];

}
