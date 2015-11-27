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
    $num_received_places = $user->num_received_places;

    $title = 'Places';
    $href = '../places/';
    $icon = 'places';
    $options = ['id' => 'places'];
    if ($num_places || $num_received_places) {

        $descriptions = [];
        if ($num_places) $descriptions[] = "$num_places total.";
        if ($num_received_places) {
            $descriptions[] = "$num_received_places received.";
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
