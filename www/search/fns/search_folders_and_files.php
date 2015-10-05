<?php

function search_folders_and_files ($mysqli, $searchFiles, $user, $keyword) {
    if ($searchFiles) {

        $dir = __DIR__.'/../../fns';

        include_once "$dir/Users/Folders/search.php";
        $folders = Users\Folders\search($mysqli, $user, $keyword);

        include_once "$dir/Users/Files/search.php";
        $files = Users\Files\search($mysqli, $user, $keyword);

    } else {
        $folders = $files = [];
    }
    return [$folders, $files];
}
