<?php

function render_bookmarks (array $bookmarks, array &$items, array $params, $keyword) {

    if ($bookmarks) {

        $regex = '/('.preg_quote(htmlspecialchars($keyword)).')+/i';

        include_once __DIR__.'/../../../fns/Page/imageArrowLinkWithDescription.php';
        foreach ($bookmarks as $bookmark) {

            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $bookmark->id_bookmarks], $params)
                )
            );
            $href = "../view/?$queryString";

            $url = htmlspecialchars($bookmark->url);
            $title = htmlspecialchars($bookmark->title);
            $title = preg_replace($regex, '<mark>$0</mark>', $title);
            $items[] = Page\imageArrowLinkWithDescription(
                $title, $url, $href, 'bookmark');

        }

    } else {
        include_once __DIR__.'/../../../fns/Page/info.php';
        $items[] = Page\info('No bookmarks found');
    }

}
