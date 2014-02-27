<?php

function search_recursively ($mysqli, $idusers, $parentidfolders, $keyword) {

    include_once __DIR__.'/../../fns/Files/searchInFolder.php';
    $files = Files\searchInFolder($mysqli, $idusers, $parentidfolders, $keyword);

    include_once __DIR__.'/../../fns/Folders/searchInFolder.php';
    $folders = Folders\searchInFolder($mysqli, $idusers, $parentidfolders, $keyword);

    include_once __DIR__.'/../../fns/Folders/indexInUserFolder.php';
    foreach (Folders\indexInUserFolder($mysqli, $idusers, $parentidfolders) as $folder) {
        list($subfolders, $subfiles) = search_recursively($mysqli, $idusers, $folder->idfolders, $keyword);
        $folders = array_merge($folders, $subfolders);
        $files = array_merge($files, $subfiles);
    }
    return array($folders, $files);

}
