<?php

function render_folder ($folder, $description, $href, &$items) {
    $title = htmlspecialchars($folder->name);
    $items[] = Page\imageArrowLinkWithDescription(
        $title, $description, $href, 'folder');
}
