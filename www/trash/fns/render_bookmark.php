<?php

function render_bookmark ($bookmark, $description, $href, &$items) {

    $title = $bookmark->title;
    if ($title === '') $title = htmlspecialchars($bookmark->url);
    else $title = htmlspecialchars($title);

    $items[] = Page\imageArrowLinkWithDescription(
        $title, $description, $href, 'bookmark');

}
