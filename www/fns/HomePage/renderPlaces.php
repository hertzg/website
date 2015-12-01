<?php

namespace HomePage;

function renderPlaces ($user, &$items) {

    $fnsDir = __DIR__.'/..';

    if ($user->show_new_place) {
        include_once "$fnsDir/Page/thumbnailLink.php";
        $items['new-place'] = \Page\thumbnailLink(
            'New Place', '../places/new/', 'create-place');
    }

    if (!$user->show_places) return;

    $num_places = $user->num_places;
    $num_new_received = $user->num_received_places -
        $user->num_archived_received_places;

    $title = 'Places';
    $href = '../places/';
    $icon = 'places';
    $options = ['id' => 'places'];
    if ($num_places || $num_new_received) {

        $descriptions = [];
        if ($num_places) $descriptions[] = "$num_places&nbsp;total.";
        if ($num_new_received) {
            $descriptions[] = "$num_new_received&nbsp;new&nbsp;received.";
        }
        $description = join(' ', $descriptions);

        include_once "$fnsDir/Page/thumbnailLinkWithDescription.php";
        $link = \Page\thumbnailLinkWithDescription($title,
            $description, $href, $icon, $options);

    } else {
        include_once "$fnsDir/Page/thumbnailLink.php";
        $link = \Page\thumbnailLink($title, $href, $icon, $options);
    }

    $items['places'] = $link;

}
