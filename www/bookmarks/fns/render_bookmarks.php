<?php

function render_bookmarks ($bookmarks, &$items, $params, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    if ($bookmarks) {

        include_once "$fnsDir/Page/imageArrowLink.php";
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";

        $icon = 'bookmark';
        foreach ($bookmarks as $bookmark) {

            $id = $bookmark->id;
            $options = ['id' => $id];
            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $id], $params)
                )
            );
            $href = "{$base}view/?$queryString";

            $escapedUrl = htmlspecialchars($bookmark->url);
            $title = $bookmark->title;
            if ($title === '') {
                $items[] = Page\imageArrowLink(
                    $escapedUrl, $href, $icon, $options);
            } else {
                $title = htmlspecialchars($title);
                $items[] = Page\imageArrowLinkWithDescription($title,
                    $escapedUrl, $href, $icon, $options);
            }

        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No bookmarks');
    }

}
