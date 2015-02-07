<?php

function render_folders_and_files ($folders, $files, &$items, $keyword) {

    $fnsDir = __DIR__.'/../../../fns';

    if ($folders || $files) {

        $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';
        $replace = '<mark>$0</mark>';

        if ($folders) {
            include_once "$fnsDir/Page/imageArrowLink.php";
            foreach ($folders as $folder) {
                $title = htmlspecialchars($folder->name);
                $title = preg_replace($regex, $replace, $title);
                $items[] = Page\imageArrowLink($title,
                    "..?id_folders=$folder->id_folders", 'folder');
            }
        }

        if ($files) {
            include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
            foreach ($files as $file) {
                $title = htmlspecialchars($file->name);
                $title = preg_replace($regex, $replace, $title);
                $items[] = Page\imageArrowLinkWithDescription($title,
                    $file->readable_size, "../view-file/?id=$file->id_files",
                    "$file->media_type-file");
            }
        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No files found');
    }

}
