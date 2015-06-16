<?php

function render_bookmarks ($bookmarks, $total,
    $groupLimit, &$items, $regex, $encodedKeyword) {

    $fnsDir = __DIR__.'/../../fns';

    $num_bookmarks = count($bookmarks);
    if ($total > $groupLimit) array_pop($bookmarks);

    include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
    foreach ($bookmarks as $bookmark) {
        $title = htmlspecialchars($bookmark->title);
        $title = preg_replace($regex, '<mark>$0</mark>', $title);
        $description = htmlspecialchars($bookmark->url);
        $query = "?id=$bookmark->id&amp;keyword=$encodedKeyword";
        $href = "../bookmarks/view/$query";
        $items[] = Page\imageArrowLinkWithDescription($title,
            $description, $href, 'bookmark');
    }

    if ($num_bookmarks < $total) {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $items[] = Page\imageArrowLink("Show All $total Bookmarks",
            "../bookmarks/search/?keyword=$encodedKeyword", 'bookmarks');
    }

}
