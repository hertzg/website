<?php

function search_recursively ($mysqli, $id_users, $parent_id_folders, $keyword) {

    include_once __DIR__.'/../../fns/Files/searchInFolder.php';
    $files = Files\searchInFolder($mysqli, $id_users, $parent_id_folders, $keyword);

    include_once __DIR__.'/../../fns/Folders/searchInFolder.php';
    $folders = Folders\searchInFolder($mysqli, $id_users, $parent_id_folders, $keyword);

    include_once __DIR__.'/../../fns/Folders/indexInUserFolder.php';
    $subfolders = Folders\indexInUserFolder($mysqli, $id_users, $parent_id_folders);

    foreach ($subfolders as $folder) {
        list($foundFolders, $foundFile) = search_recursively($mysqli, $id_users,
            $folder->id_folders, $keyword);
        $folders = array_merge($folders, $foundFolders);
        $files = array_merge($files, $foundFile);
    }
    return [$folders, $files];

}
