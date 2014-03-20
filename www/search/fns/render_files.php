<?php

function render_files (array $files, array &$items) {
    include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
    foreach ($files as $file) {
        $items[] = Page\imageArrowLink(htmlspecialchars($file->filename),
            "../files/view-file/?id=$file->idfiles", 'file');
    }
}
