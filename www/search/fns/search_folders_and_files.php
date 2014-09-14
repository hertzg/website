<?php

function search_folders_and_files ($mysqli, $searchFiles, $id_users, $keyword) {
    if ($searchFiles) {

        $dir = __DIR__.'/../../fns';

        include_once "$dir/Folders/search.php";
        $folders = Folders\search($mysqli, $id_users, $keyword);

        include_once "$dir/Files/search.php";
        $files = Files\search($mysqli, $id_users, $keyword);

    } else {
        $folders = $files = [];
    }
    return [$folders, $files];
}
