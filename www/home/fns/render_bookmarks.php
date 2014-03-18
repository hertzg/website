<?php

function render_bookmarks ($user, array &$items) {

    if (!$user->show_bookmarks) return;

    $key = 'bookmarks';
    $num_bookmarks = $user->num_bookmarks;
    $title = 'Bookmarks';
    $href = '../bookmarks/';
    $icon = 'bookmarks';
    if ($num_bookmarks) {
        include_once __DIR__.'/../../fns/Page/imageArrowLinkWithDescription.php';
        $description = "$num_bookmarks total.";
        $items[$key] = Page\imageArrowLinkWithDescription($title,
            $description, $href, $icon);
    } else {
        include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
        $items[$key] = Page\imageArrowLink($title, $href, $icon);
    }

}
