<?php

function render_folders_and_files ($folders, $files, &$items, $keyword) {

    if ($folders || $files) {

        $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';
        $replace = '<mark>$0</mark>';

        include_once __DIR__.'/../../../fns/Page/imageArrowLink.php';

        foreach ($folders as $i => $folder) {
            $title = htmlspecialchars($folder->name);
            $title = preg_replace($regex, $replace, $title);
            $href = "..?id_folders=$folder->id_folders";
            $items[] = Page\imageArrowLink($title, $href, 'folder');
        }

        foreach ($files as $i => $file) {
            $title = htmlspecialchars($file->name);
            $title = preg_replace($regex, $replace, $title);
            $href = "../view-file/?id=$file->id_files";
            $icon = "$file->media_type-file";
            $items[] = Page\imageArrowLink($title, $href, $icon);
        }

    } else {
        include_once __DIR__.'/../../../fns/Page/info.php';
        $items[] = Page\info('No files found');
    }

}
