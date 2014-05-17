<?php

function render_folders (array $folders, array &$items, $regex) {
    include_once __DIR__.'/../../fns/create_folder_link.php';
    include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
    foreach ($folders as $folder) {
        $title = htmlspecialchars($folder->name);
        $title = preg_replace($regex, '<mark>$0</mark>', $title);
        $href = create_folder_link($folder->id_folders, '../files/');
        $items[] = Page\imageArrowLink($title, $href, 'folder');
    }
}
