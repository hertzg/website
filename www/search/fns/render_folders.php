<?php

function render_folders ($folders, &$items, $regex) {
    $fnsDir = __DIR__.'/../../fns';
    include_once "$fnsDir/create_folder_link.php";
    include_once "$fnsDir/Page/imageArrowLink.php";
    foreach ($folders as $folder) {
        $title = htmlspecialchars($folder->name);
        $title = preg_replace($regex, '<mark>$0</mark>', $title);
        $href = create_folder_link($folder->id_folders, '../files/');
        $items[] = Page\imageArrowLink($title, $href, 'folder');
    }
}
