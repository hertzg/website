<?php

function search_recursively ($mysqli, $id_users, $parent_id, $keyword) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Files/searchInFolder.php";
    $files = Files\searchInFolder($mysqli, $id_users, $parent_id, $keyword);

    include_once "$fnsDir/Folders/searchInFolder.php";
    $folders = Folders\searchInFolder($mysqli, $id_users, $parent_id, $keyword);

    include_once "$fnsDir/Folders/indexInUserFolder.php";
    $subfolders = Folders\indexInUserFolder($mysqli, $id_users, $parent_id);

    foreach ($subfolders as $folder) {
        list($foundFolders, $foundFile) = search_recursively($mysqli,
            $id_users, $folder->id_folders, $keyword);
        $folders = array_merge($folders, $foundFolders);
        $files = array_merge($files, $foundFile);
    }
    return [$folders, $files];

}
