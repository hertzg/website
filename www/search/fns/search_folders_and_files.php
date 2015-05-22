<?php

function search_folders_and_files ($mysqli, $searchFiles, $user, $keyword) {
    if ($searchFiles) {

        $dir = __DIR__.'/../../fns';

        include_once "$dir/Users/Folders/search.php";
        $folders = Users\Folders\search($mysqli, $user, $keyword);

        include_once "$dir/Files/search.php";
        $files = Files\search($mysqli, $user->id_users, $keyword);

    } else {
        $folders = $files = [];
    }
    return [$folders, $files];
}
