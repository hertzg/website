<?php

function render_bookmarks (array $bookmarks, array &$items) {
    include_once __DIR__.'/../../fns/Page/imageArrowLinkWithDescription.php';
    foreach ($bookmarks as $bookmark) {
        $title = htmlspecialchars($bookmark->title);
        $description = htmlspecialchars($bookmark->url);
        $href = "../bookmarks/view/?id=$bookmark->id_bookmarks";
        $items[] = Page\imageArrowLinkWithDescription($title, $description,
            $href, 'bookmark');
    }
}
