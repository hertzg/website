<?php

namespace ViewPage;

function pointsPanel ($mysqli, $place) {

    $num_points = $place->num_points;

    $id = $place->id;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    include_once "$fnsDir/Page/newItemButton.php";
    $newItemButton = \Page\newItemButton(
        '../new-point/'.\ItemList\escapedItemQuery($id), 'Point');

    $limit = 5;

    include_once "$fnsDir/PlacePoints/indexLimitOnPlace.php";
    $points = \PlacePoints\indexLimitOnPlace($mysqli, $id, $limit);

    $items = [];

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    include_once "$fnsDir/Page/imageArrowLink.php";
    foreach ($points as $point) {
        $escapedItemQuery = \ItemList\escapedItemQuery($point->id);
        $items[] =
            \Page\imageArrowLink("$point->latitude $point->longitude",
                "../view-point/$escapedItemQuery", 'point');
    }

    if ($num_points > $limit) {
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        $items[] = \Page\imageArrowLinkWithDescription('All Points',
            "$num_points total.", "../all-points/?id=$id", 'points',
            ['id' => 'all-points']);
    }

    include_once "$fnsDir/Page/panel.php";
    return \Page\panel('Points',
        join('<div class="hr"></div>', $items), $newItemButton);

}
