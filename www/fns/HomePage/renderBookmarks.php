<?php

namespace HomePage;

function renderBookmarks ($user) {

    $fnsDir = __DIR__.'/..';

    $num_bookmarks = $user->num_bookmarks;
    $num_new_received = $user->num_received_bookmarks -
        $user->num_archived_received_bookmarks;

    $title = 'Bookmarks';
    $href = '../bookmarks/';
    $icon = 'bookmarks';
    $options = ['id' => 'bookmarks'];

    if ($num_bookmarks || $num_new_received) {

        $descriptions = [];
        if ($num_bookmarks) $descriptions[] = "$num_bookmarks&nbsp;total.";
        if ($num_new_received) {
            $descriptions[] = "$num_new_received&nbsp;new&nbsp;received.";
        }
        $description = join(' ', $descriptions);

        include_once "$fnsDir/Page/thumbnailLinkWithDescription.php";
        return \Page\thumbnailLinkWithDescription(
            $title, $description, $href, $icon, $options);

    }

    include_once "$fnsDir/Page/thumbnailLink.php";
    return \Page\thumbnailLink($title, $href, $icon, $options);

}
