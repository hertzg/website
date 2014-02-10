<?php

function search_recursively ($mysqli, $idusers, $parentidfolders, $keyword) {

    include_once __DIR__.'/../../fns/Files/search.php';
    $files = Files\search($mysqli, $idusers, $parentidfolders, $keyword);

    $folders = Folders::search($idusers, $parentidfolders, $keyword);
    foreach (Folders::index($idusers, $parentidfolders) as $folder) {
        list($subfolders, $subfiles) = search_recursively($mysqli, $idusers, $folder->idfolders, $keyword);
        $folders = array_merge($folders, $subfolders);
        $files = array_merge($files, $subfiles);
    }
    return array($folders, $files);

}

include_once __DIR__.'/../../classes/Folders.php';
