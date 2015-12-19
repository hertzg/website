<?php

function render_place ($place, &$title, &$icon) {

    $name = $place->name;
    if ($name === '') $title = "$place->latitude $place->longitude";
    else $title = htmlspecialchars($name);

    $icon = 'place';

}
