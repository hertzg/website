<?php

function render_folders_and_files ($folders, $files, &$items, $base) {

    $fnsDir = __DIR__.'/../../fns';

    if ($folders || $files) {

        if ($folders) {
            include_once "$fnsDir/Page/imageLink.php";
            foreach ($folders as $folder) {
                $id = $folder->id_folders;
                $items[] = Page\imageLink(htmlspecialchars($folder->name),
                    "?id_folders=$id", 'folder', ['id' => "folder_$id"]);
            }
        }

        if ($files) {
            include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
            foreach ($files as $file) {
                $id = $file->id_files;
                $items[] = Page\imageArrowLinkWithDescription(
                    htmlspecialchars($file->name), $file->readable_size,
                    "{$base}view-file/?id=$id", "$file->media_type-file",
                    ['id' => "file_$id"]);
            }
        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('Folder is empty');
    }

}
