<?php

function search_recursively ($idusers, $parentidfolders, $keyword) {
    $files = Files::search($idusers, $parentidfolders, $keyword);
    $folders = Folders::search($idusers, $parentidfolders, $keyword);
    foreach (Folders::index($idusers, $parentidfolders) as $folder) {
        list($subfolders, $subfiles) = search_recursively($idusers, $folder->idfolders, $keyword);
        $folders = array_merge($folders, $subfolders);
        $files = array_merge($files, $subfiles);
    }
    return array($folders, $files);
}

include_once __DIR__.'/../../classes/Files.php';
include_once __DIR__.'/../../classes/Folders.php';
