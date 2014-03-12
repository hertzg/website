<?php

function render_folders_and_files (array $folders, array $files, &$items,
    $emptyMessage, $base = '../') {

    if ($folders || $files) {

        include_once __DIR__.'/../../fns/Page/imageArrowLink.php';

        foreach ($folders as $i => $folder) {
            $title = htmlspecialchars($folder->foldername);
            $href = "?idfolders=$folder->idfolders";
            $items[] = Page\imageArrowLink($title, $href, 'folder');
        }

        foreach ($files as $i => $file) {
            $title = htmlspecialchars($file->filename);
            $href = "view-file/?id=$file->idfiles";
            $items[] = Page\imageArrowLink($title, $href, 'file');
        }

    } else {
        include_once __DIR__.'/../../fns/Page/info.php';
        $items[] = Page\info($emptyMessage);
    }

}
