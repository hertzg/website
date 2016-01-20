<?php

function render_folders_and_files ($folders, $num_folders, $files,
    $num_files, $groupLimit, &$items, $regex, $encodedKeyword) {

    $fnsDir = __DIR__.'/../../fns';
    $total = $total = $num_folders + $num_files;
    $number = 0;

    $renderShowAll = function () use ($fnsDir,
        $total, $encodedKeyword, &$items) {

        include_once "$fnsDir/Page/imageArrowLink.php";
        $items[] = Page\imageArrowLink("Show All $total Files",
            "../files/search/?keyword=$encodedKeyword&deep=1", 'files');

    };

    if ($num_folders) {
        include_once "$fnsDir/Page/imageArrowLink.php";
        foreach ($folders as $folder) {

            if ($number === $groupLimit - 1 && $total > $groupLimit) {
                $renderShowAll();
                return;
            }
            $number++;

            $title = htmlspecialchars($folder->name);
            $title = preg_replace($regex, '<mark>$0</mark>', $title);
            $items[] = Page\imageArrowLink($title,
                "../files/?id_folders=$folder->id_folders", 'folder');

        }
    }

    if ($num_files) {
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        foreach ($files as $file) {

            if ($number === $groupLimit - 1 && $total > $groupLimit) {
                $renderShowAll();
                return;
            }
            $number++;

            $title = htmlspecialchars($file->name);
            $title = preg_replace($regex, '<mark>$0</mark>', $title);
            $items[] = Page\imageArrowLinkWithDescription($title,
                $file->readable_size, "../files/view-file/?id=$file->id_files",
                "$file->media_type-file");

        }
    }

}
