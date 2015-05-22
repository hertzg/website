<?php

namespace HomePage;

function renderBookmarks ($user, &$items) {

    $fnsDir = __DIR__.'/..';

    if ($user->show_new_bookmark) {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $items['new-bookmark'] = \Page\imageArrowLink(
            'New Bookmark', '../bookmarks/new/', 'create-bookmark');
    }

    if (!$user->show_bookmarks) return;

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
