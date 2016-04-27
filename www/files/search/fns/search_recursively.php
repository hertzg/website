<?php

function search_recursively ($mysqli,
    $user, $parent_id, $includes, $excludes) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Users/Files/searchInFolder.php";
    $files = Users\Files\searchInFolder($mysqli,
        $user, $parent_id, $includes, $excludes);

    include_once "$fnsDir/Users/Folders/searchInFolder.php";
    $folders = Users\Folders\searchInFolder($mysqli,
        $user, $parent_id, $includes, $excludes);

    include_once "$fnsDir/Users/Folders/index.php";
    $subfolders = Users\Folders\index($mysqli, $user, $parent_id);

    foreach ($subfolders as $folder) {
        list($foundFolders, $foundFile) = search_recursively($mysqli,
            $user, $folder->id_folders, $includes, $excludes);
        $folders = array_merge($folders, $foundFolders);
        $files = array_merge($files, $foundFile);
    }
    return [$folders, $files];

}
