<?php

function render_folder ($folder, $description, $href, $options, &$items) {
    $title = htmlspecialchars($folder->name);
    $items[] = Page\imageArrowLinkWithDescription(
        $title, $description, $href, 'folder', $options);
}
