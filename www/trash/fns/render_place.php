<?php

function render_place ($place, $description, $href, $options, &$items) {

    $name = $place->name;
    if ($name === '') $title = "$place->latitude $place->longitude";
    else $title = htmlspecialchars($name);

    $items[] = Page\imageArrowLinkWithDescription(
        $title, $description, $href, 'place', $options);

}
