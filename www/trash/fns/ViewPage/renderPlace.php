<?php

namespace ViewPage;

function renderPlace ($place, &$items) {

    include_once __DIR__.'/../../../fns/Form/label.php';
    $items[] = \Form\label('Latitude', $place->latitude);
    $items[] = \Form\label('Longitude', $place->longitude);

    $altitude = $place->altitude;
    if ($altitude !== null) $items[] = \Form\label('Altitude', $altitude);

    $name = $place->name;
    if ($name !== '') $items[] = \Form\label('Name', htmlspecialchars($name));

    $tags = $place->tags;
    if ($tags !== '') $items[] = \Form\label('Tags', htmlspecialchars($tags));

}
