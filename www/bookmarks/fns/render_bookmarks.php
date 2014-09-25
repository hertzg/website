<?php

function render_bookmarks ($bookmarks, &$items, $params, $base = '') {

    $fnsPageDir = __DIR__.'/../../fns/Page';

    if ($bookmarks) {

        include_once "$fnsPageDir/imageArrowLink.php";
        include_once "$fnsPageDir/imageArrowLinkWithDescription.php";

        $icon = 'bookmark';
        foreach ($bookmarks as $bookmark) {

            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $bookmark->id_bookmarks], $params)
                )
            );
            $href = "{$base}view/?$queryString";

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
        include_once "$fnsPageDir/info.php";
        $items[] = Page\info('No bookmarks');
    }

}
