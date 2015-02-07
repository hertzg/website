<?php

function render_files ($files, &$items, $regex) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
    foreach ($files as $file) {
        $title = htmlspecialchars($file->name);
        $title = preg_replace($regex, '<mark>$0</mark>', $title);
        $items[] = Page\imageArrowLinkWithDescription($title,
            $file->readable_size, "../files/view-file/?id=$file->id_files",
            "$file->media_type-file");
    }

}
