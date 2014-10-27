<?php

namespace SearchPage;

function renderBookmarks ($bookmarks, &$items, $params, $keyword) {

    $fnsDir = __DIR__.'/../../../fns';

    if ($bookmarks) {

        $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';

        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        foreach ($bookmarks as $bookmark) {

            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $bookmark->id], $params)
                )
            );
            $href = "../view/?$queryString";

            $url = htmlspecialchars($bookmark->url);
            $title = htmlspecialchars($bookmark->title);
            $title = preg_replace($regex, '<mark>$0</mark>', $title);
            $items[] = \Page\imageArrowLinkWithDescription(
                $title, $url, $href, 'bookmark');

        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = \Page\info('No bookmarks found');
    }

}
