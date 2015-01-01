<?php

function render_folders_and_files ($folders, $files, &$items) {

    if ($folders || $files) {

        include_once __DIR__.'/../../fns/Page/imageArrowLink.php';

        foreach ($folders as $folder) {
            $id = $folder->id_folders;
            $items[] = Page\imageArrowLink(htmlspecialchars($folder->name),
                "?id_folders=$id", 'folder', ['id' => "folder_$id"]);
        }

        foreach ($files as $file) {
            $id = $file->id_files;
            $items[] = Page\imageArrowLink(htmlspecialchars($file->name),
                "view-file/?id=$id", "$file->media_type-file",
                ['id' => "file_$id"]);
        }

    } else {
        include_once __DIR__.'/../../fns/Page/info.php';
        $items[] = Page\info('Folder is empty');
    }

}
