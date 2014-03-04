<?php

function render_bookmarks (array $bookmarks, array &$items) {
    foreach ($bookmarks as $bookmark) {
        $title = htmlspecialchars($bookmark->title);
        $description = htmlspecialchars($bookmark->url);
        $href = "../bookmarks/view/?id=$bookmark->idbookmarks";
        $items[] = Page::imageArrowLinkWithDescription($title, $description,
            $href, 'bookmark');
    }
}
