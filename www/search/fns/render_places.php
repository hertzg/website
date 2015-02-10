<?php

function render_places ($places, &$items, $regex, $encodedKeyword) {
    include_once __DIR__.'/../../fns/create_place_link.php';
    foreach ($places as $place) {

        $escapedName = htmlspecialchars($place->name);
        $title = preg_replace($regex, '<mark>$0</mark>', $escapedName);

        $query = "?id=$place->id&amp;keyword=$encodedKeyword";
        $href = "../places/view/$query";
        $items[] = create_place_link($place->latitude,
            $place->longitude, $title, $place->tags, $href);

    }
}
