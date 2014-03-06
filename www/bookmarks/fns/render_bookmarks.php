<?php

function render_bookmarks (array $bookmarks, array &$items, $base = '') {
    if ($bookmarks) {
        $icon = 'bookmark';
        foreach ($bookmarks as $bookmark) {
            $href = "{$base}view/?id=$bookmark->idbookmarks";
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
        include_once __DIR__.'/../../fns/Page/info.php';
        $items[] = Page\info('No bookmarks.');
    }
}
