<?php

namespace HomePage;

function renderPlaces ($user) {

    $fnsDir = __DIR__.'/..';

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
        return \Page\thumbnailLinkWithDescription($title,
            $description, $href, $icon, $options);

    }

    include_once "$fnsDir/Page/thumbnailLink.php";
    return \Page\thumbnailLink($title, $href, $icon, $options);

}
