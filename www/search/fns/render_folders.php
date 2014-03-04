<?php

function render_folders (array $folders, array &$items) {
    if ($folders) {
        include_once __DIR__.'/../../files/fns/create_folder_link.php';
        foreach ($folders as $folder) {
            $title = htmlspecialchars($folder->foldername);
            $href = create_folder_link($folder->idfolders, '../files/');
            $items[] = Page::imageArrowLink($title, $href, 'folder');
        }
    }
}
