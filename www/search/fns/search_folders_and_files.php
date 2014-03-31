<?php

function search_folders_and_files ($mysqli, $searchFiles, $id_users, $keyword) {
    if ($searchFiles) {

        include_once __DIR__.'/../../fns/Folders/search.php';
        $folders = Folders\search($mysqli, $id_users, $keyword);

        include_once __DIR__.'/../../fns/Files/search.php';
        $files = Files\search($mysqli, $id_users, $keyword);

    } else {
        $folders = $files = [];
    }
    return [$folders, $files];
}
