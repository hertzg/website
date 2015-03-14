<?php

namespace ViewPage;

function pointsPanel ($mysqli, $place) {

    $num_points = $place->num_points;
    if ($num_points < 2) return;

    $id = $place->id;
    $fnsDir = __DIR__.'/../../../fns';

    $limit = 5;

    include_once "$fnsDir/PlacePoints/indexLimitOnPlace.php";
    $points = \PlacePoints\indexLimitOnPlace($mysqli, $id, $limit);

    $items = [];

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    include_once "$fnsDir/Page/imageArrowLink.php";
    foreach ($points as $point) {

        $escapedItemQuery = \ItemList\escapedItemQuery($point->id);
        $delete_url = "../delete-point/submit.php$escapedItemQuery";

        $items[] =
            "<div class=\"deleteLinkWrapper\" data-delete_url=\"$delete_url\">"
                .\Page\imageArrowLink("$point->latitude $point->longitude",
                    "../view-point/$escapedItemQuery", 'place')
            .'</div>';

    }

    if ($num_points > $limit) {
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        $items[] = \Page\imageArrowLinkWithDescription('All Points',
            "$num_points total.", "../all-points/?id=$id", 'places',
            ['id' => 'all-points']);
    }

    include_once "$fnsDir/create_panel.php";
    return create_panel('Points', join('<div class="hr"></div>', $items));

}
