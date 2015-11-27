<?php

namespace HomePage;

function renderBookmarks ($user, &$items) {

    $fnsDir = __DIR__.'/..';

    if ($user->show_new_bookmark) {
        include_once "$fnsDir/Page/thumbnailLink.php";
        $items['new-bookmark'] = \Page\thumbnailLink(
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

        include_once "$fnsDir/Page/thumbnailLinkWithDescription.php";
        $link = \Page\thumbnailLinkWithDescription(
            $title, $description, $href, $icon, $options);

    } else {
        include_once "$fnsDir/Page/thumbnailLink.php";
        $link = \Page\thumbnailLink($title, $href, $icon, $options);
    }

    $items['bookmarks'] = $link;

}
