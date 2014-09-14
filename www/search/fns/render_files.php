<?php

function render_files ($files, &$items, $regex) {
    include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
    foreach ($files as $file) {
        $title = htmlspecialchars($file->name);
        $title = preg_replace($regex, '<mark>$0</mark>', $title);
        $href = "../files/view-file/?id=$file->id_files";
        $items[] = Page\imageArrowLink($title, $href, 'file');
    }
}
