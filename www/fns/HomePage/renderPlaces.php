<?php

namespace HomePage;

function renderPlaces ($user, &$items) {

    if (!$user->show_places) return;

    $fnsDir = __DIR__.'/..';

    $num_places = $user->num_places;
    $num_received_places = $user->num_received_places;

    $title = 'Places';
    $href = '../places/';
    $icon = 'places';
    $options = ['id' => 'places'];
    if ($num_places || $num_received_places) {

        $descriptionItems = [];
        if ($num_places) $descriptionItems[] = "$num_places total.";
        if ($num_received_places) {
            $descriptionItems[] = "$num_received_places received.";
        }
        $description = join(' ', $descriptionItems);

        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        $link = \Page\imageArrowLinkWithDescription($title,
            $description, $href, $icon, $options);

    } else {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $link = \Page\imageArrowLink($title, $href, $icon, $options);
    }

    $items['places'] = $link;

}
