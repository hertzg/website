<?php

namespace HomePage;

function renderBookmarks ($user, &$items) {

    if (!$user->show_bookmarks) return;

    $fnsDir = __DIR__.'/..';

    $num_bookmarks = $user->num_bookmarks;
    $num_received_bookmarks = $user->num_received_bookmarks;

    $title = 'Bookmarks';
    $href = '../bookmarks/';
    $icon = 'bookmarks';
    $options = ['id' => 'bookmarks'];
    if ($num_bookmarks || $num_received_bookmarks) {

        $descriptions = [];
        if ($num_bookmarks) $descriptions[] = "$num_bookmarks total.";
        if ($num_received_bookmarks) {
            $descriptions[] = "$num_received_bookmarks received.";
        }
        $description = join(' ', $descriptions);

        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        $link = \Page\imageArrowLinkWithDescription(
            $title, $description, $href, $icon, $options);

    } else {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $link = \Page\imageArrowLink($title, $href, $icon, $options);
    }

    $items['bookmarks'] = $link;

}
