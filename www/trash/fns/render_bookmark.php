<?php

function render_bookmark ($bookmark, $description, $href, $options, &$items) {

    $title = $bookmark->title;
    if ($title === '') $title = $bookmark->url;
    $title = htmlspecialchars($title);

    $items[] = Page\imageArrowLinkWithDescription(
        $title, $description, $href, 'bookmark', $options);

}
