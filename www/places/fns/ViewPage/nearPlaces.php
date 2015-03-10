<?php

namespace ViewPage;

function nearPlaces ($mysqli, $place) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Places/indexNear.php";
    $nearPlaces = \Places\indexNear($mysqli,
        $place->latitude, $place->longitude, $place->id, 5);

    if (!$nearPlaces) return;

    include_once "$fnsDir/Page/imageArrowLink.php";
    include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
    $items = [];
    foreach ($nearPlaces as $place) {

        $name = $place->name;
        if ($name === '') $title = "$place->latitude $place->longitude";
        else $title = htmlspecialchars($name);

        $href = "../view/?id=$place->id";
        $icon = 'place';

        $description = $place->description;
        if ($description === '') {
            $link = \Page\imageArrowLink($title, $href, $icon);
        } else {
            $link = \Page\imageArrowLinkWithDescription(
                $title, $description, $href, $icon);
        }

        $items[] = $link;

    }

    $content = join('<div class="hr"></div>', $items);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Places Nearby', $content);

}
