<?php

function render_files (array $files, array &$items) {
    include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
    foreach ($files as $file) {
        $items[] = Page\imageArrowLink(htmlspecialchars($file->file_name),
            "../files/view-file/?id=$file->id_files", 'file');
    }
}
