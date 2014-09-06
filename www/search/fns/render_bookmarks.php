<?php

function render_bookmarks (array $bookmarks,
    array &$items, $regex, $encodedKeyword) {

    include_once __DIR__.'/../../fns/Page/imageArrowLinkWithDescription.php';
    foreach ($bookmarks as $bookmark) {
        $title = htmlspecialchars($bookmark->title);
        $title = preg_replace($regex, '<mark>$0</mark>', $title);
        $description = htmlspecialchars($bookmark->url);
        $query = "?id=$bookmark->id_bookmarks&amp;keyword=$encodedKeyword";
        $href = "../bookmarks/view/$query";
        $items[] = Page\imageArrowLinkWithDescription($title, $description,
            $href, 'bookmark');
    }

}
