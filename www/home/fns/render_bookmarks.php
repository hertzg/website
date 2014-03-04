<?php

function render_bookmarks ($user, array &$items) {
    $num_bookmarks = $user->num_bookmarks;
    $title = 'Bookmarks';
    $href = '../bookmarks/';
    $icon = 'bookmarks';
    if ($num_bookmarks) {
        $description = "$num_bookmarks total.";
        $items[] = Page::imageArrowLinkWithDescription($title,
            $description, $href, $icon);
    } else {
        $items[] = Page::imageArrowLink($title, $href, $icon);
    }
}
