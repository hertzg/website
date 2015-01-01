<?php

function render_file ($file, $description, $href, $options, &$items) {
    $title = htmlspecialchars($file->name);
    $icon = "$file->media_type-file";
    $items[] = Page\imageArrowLinkWithDescription(
        $title, $description, $href, $icon, $options);
}
