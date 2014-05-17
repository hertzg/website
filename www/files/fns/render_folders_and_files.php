<?php

function render_folders_and_files (array $folders, array $files, &$items) {

    if ($folders || $files) {

        include_once __DIR__.'/../../fns/Page/imageArrowLink.php';

        foreach ($folders as $i => $folder) {
            $title = htmlspecialchars($folder->name);
            $href = "?id_folders=$folder->id_folders";
            $items[] = Page\imageArrowLink($title, $href, 'folder');
        }

        foreach ($files as $i => $file) {
            $title = htmlspecialchars($file->name);
            $href = "view-file/?id=$file->id_files";
            $items[] = Page\imageArrowLink($title, $href, 'file');
        }

    } else {
        include_once __DIR__.'/../../fns/Page/info.php';
        $items[] = Page\info('Folder is empty');
    }

}
