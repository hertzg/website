<?php

function render_places ($places, $total,
    $groupLimit, &$items, $regex, $encodedKeyword) {

    $fnsDir = __DIR__.'/../../fns';

    $num_places = count($places);
    if ($total > $groupLimit) array_pop($places);

    include_once "$fnsDir/create_place_link.php";
    foreach ($places as $place) {

        $escapedName = htmlspecialchars($place->name);
        $title = preg_replace($regex, '<mark>$0</mark>', $escapedName);

        $query = "?id=$place->id&amp;keyword=$encodedKeyword";
        $href = "../places/view/$query";
        $items[] = create_place_link($place->latitude,
            $place->longitude, $title, $place->tags_json, $href);

    }

    if ($num_places < $total) {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $items[] = Page\imageArrowLink("Show All $total Places",
            "../places/search/?keyword=$encodedKeyword", 'places');
    }

}
