<?php

namespace ViewPage;

function nearPlaces ($mysqli, $place) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Places/indexNearOnUser.php";
    $nearPlaces = \Places\indexNearOnUser($mysqli, $place->id_users,
        $place->latitude, $place->longitude, $place->id, 5);

    if (!$nearPlaces) return;

    include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
    $items = [];
    foreach ($nearPlaces as $place) {

        $name = $place->name;
        if ($name === '') $title = "$place->latitude $place->longitude";
        else $title = htmlspecialchars($name);

        $link = \Page\imageArrowLinkWithDescription($title,
            'In '.round($place->distance).' metres', "../view/?id=$place->id",
            'place');

        $items[] = $link;

    }

    $content = join('<div class="hr"></div>', $items);

    include_once "$fnsDir/Page/panel.php";
    return \Page\panel('Places Nearby', $content);

}
