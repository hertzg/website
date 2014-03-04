<?php

function render_files (array $files, array &$items) {
    foreach ($files as $file) {
        $items[] = Page::imageArrowLink(htmlspecialchars($file->filename),
            "../files/view-file/?id=$file->idfiles", 'file');
    }
}
