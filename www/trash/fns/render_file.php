<?php

function render_file ($file, $description, $href, &$items) {
    $title = htmlspecialchars($file->name);
    $items[] = Page\imageArrowLinkWithDescription(
        $title, $description, $href, 'file');
}
