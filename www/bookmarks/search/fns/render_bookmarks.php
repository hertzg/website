<?php

function render_bookmarks (array $bookmarks, array &$items) {
    if ($bookmarks) {

        include_once __DIR__.'/../../../fns/Page/imageArrowLink.php';
        include_once __DIR__.'/../../../fns/Page/imageArrowLinkWithDescription.php';

        $icon = 'bookmark';
        foreach ($bookmarks as $bookmark) {
            $title = htmlspecialchars($bookmark->title);
            $href = "../view/?id=$bookmark->id_bookmarks";
            $description = htmlspecialchars($bookmark->url);
            $items[] = Page\imageArrowLinkWithDescription($title,
                $description, $href, $icon);
        }

    } else {
        include_once __DIR__.'/../../../fns/Page/info.php';
        $items[] = Page\info('No bookmarks found');
    }
}
