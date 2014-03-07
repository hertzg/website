<?php

function render_bookmarks ($user, array &$items) {
    $num_bookmarks = $user->num_bookmarks;
    $title = 'Bookmarks';
    $href = '../bookmarks/';
    $icon = 'bookmarks';
    if ($num_bookmarks) {
        include_once __DIR__.'/../../fns/Page/imageArrowLinkWithDescription.php';
        $description = "$num_bookmarks total.";
        $items[] = Page\imageArrowLinkWithDescription($title,
            $description, $href, $icon);
    } else {
        include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
        $items[] = Page\imageArrowLink($title, $href, $icon);
    }
}
