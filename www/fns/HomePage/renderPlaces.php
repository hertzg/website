<?php

namespace HomePage;

function renderPlaces ($user, &$items) {

    $fnsDir = __DIR__.'/..';

    if ($user->show_new_place) {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $items['new-place'] = \Page\imageArrowLink(
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

        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        $link = \Page\imageArrowLinkWithDescription($title,
            $description, $href, $icon, $options);

    } else {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $link = \Page\imageArrowLink($title, $href, $icon, $options);
    }

    $items['places'] = $link;

}
