<?php

namespace HomePage;

function renderPlaces ($user, &$items) {

    if (!$user->show_places) return;

    $fnsDir = __DIR__.'/..';

    $num_places = $user->num_places;

    $title = 'Places';
    $href = '../places/';
    $icon = 'places-TODO';
    $options = ['id' => 'places'];
    if ($num_places) {

        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        $link = \Page\imageArrowLinkWithDescription($title,
            "$num_places total.", $href, $icon, $options);

    } else {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $link = \Page\imageArrowLink($title, $href, $icon, $options);
    }

    $items['places'] = $link;

}
