<?php

namespace SearchPage;

function renderBookmarks ($bookmarks, &$items, $params, $includes) {

    $fnsDir = __DIR__.'/../../../fns';

    if ($bookmarks) {

        include_once "$fnsDir/keyword_regex.php";
        $regex = keyword_regex($includes);

        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        foreach ($bookmarks as $bookmark) {

            $id = $bookmark->id;
            $options = ['id' => $id];
            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $id], $params)
                )
            );
            $href = "../view/?$queryString";

            $url = htmlspecialchars($bookmark->url);
            $title = htmlspecialchars($bookmark->title);
            $title = preg_replace($regex, '<mark>$0</mark>', $title);
            $items[] = \Page\imageArrowLinkWithDescription(
                $title, $url, $href, 'bookmark', $options);

        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = \Page\info('No bookmarks found');
    }

}
