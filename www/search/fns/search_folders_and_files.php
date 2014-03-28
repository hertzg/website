<?php

function search_folders_and_files ($mysqli, $searchFiles, $idusers, $keyword) {
    if ($searchFiles) {

        include_once __DIR__.'/../../fns/Folders/search.php';
        $folders = Folders\search($mysqli, $idusers, $keyword);

        include_once __DIR__.'/../../fns/Files/search.php';
        $files = Files\search($mysqli, $idusers, $keyword);

    } else {
        $folders = $files = [];
    }
    return [$folders, $files];
}
