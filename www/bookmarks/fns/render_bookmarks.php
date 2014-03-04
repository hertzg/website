<?php

function render_bookmarks (array $bookmarks, array &$items) {
    if ($bookmarks) {
        $icon = 'bookmark';
        foreach ($bookmarks as $bookmark) {
            $href = "view/?id=$bookmark->idbookmarks";
            $escapedUrl = htmlspecialchars($bookmark->url);
            $title = $bookmark->title;
            if ($title === '') {
                $items[] = Page::imageArrowLink($escapedUrl, $href, $icon);
            } else {
                $title = htmlspecialchars($title);
                $items[] = Page::imageArrowLinkWithDescription($title,
                    $escapedUrl, $href, $icon);
            }
        }
    } else {
        $items[] = Page::info('No bookmarks.');
    }
}
