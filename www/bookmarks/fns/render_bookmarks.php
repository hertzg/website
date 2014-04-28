<?php

function render_bookmarks (array $bookmarks, array &$items, array $params) {

    if ($bookmarks) {

        include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
        include_once __DIR__.'/../../fns/Page/imageArrowLinkWithDescription.php';

        $icon = 'bookmark';
        foreach ($bookmarks as $bookmark) {

            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $bookmark->id_bookmarks], $params)
                )
            );
            $href = "view/?$queryString";

            $escapedUrl = htmlspecialchars($bookmark->url);
            $title = $bookmark->title;
            if ($title === '') {
                $items[] = Page\imageArrowLink($escapedUrl, $href, $icon);
            } else {
                $title = htmlspecialchars($title);
                $items[] = Page\imageArrowLinkWithDescription($title,
                    $escapedUrl, $href, $icon);
            }

        }

    } else {
        include_once __DIR__.'/../../fns/Page/info.php';
        $items[] = Page\info('No bookmarks');
    }

}
