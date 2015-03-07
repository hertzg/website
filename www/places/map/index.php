<?php

include_once '../fns/require_places.php';
$user = require_places();
$id_users = $user->id_users;

$fnsDir = '../../fns';

include_once "$fnsDir/request_strings.php";
list($tag) = request_strings('tag');

include_once "$fnsDir/Paging/requestOffset.php";
$offset = Paging\requestOffset();

include_once "$fnsDir/Paging/limit.php";
$limit = \Paging\limit();

include_once '../../lib/mysqli.php';

if ($tag === '') {
    include_once "$fnsDir/Places/indexOnUser.php";
    $places = Places\indexOnUser($mysqli, $id_users);
} else {
    include_once "$fnsDir/PlaceTags/indexPageOnUserTagName.php";
    $places = PlaceTags\indexPageOnUserTagName($mysqli,
        $id_users, $tag, $offset, $limit, $total);
}

if ($places) {
    $firstPlace = $places[0];
    $max_latitude = $min_latitude = $firstPlace->latitude;
    $max_longitude = $min_longitude = $firstPlace->longitude;
    if (count($places) > 1) {
        foreach ($places as $place) {
            $max_latitude = max($max_latitude, $place->latitude);
            $max_longitude = max($max_longitude, $place->longitude);
            $min_latitude = min($min_latitude, $place->latitude);
            $min_longitude = min($min_longitude, $place->longitude);
        }
        $scale = 180 / max($max_latitude - $min_latitude, $max_longitude - $min_longitude);
        $scale = min(100000, $scale);
    } else {
        $scale = 180;
    }
    $median_latitude = ($max_latitude + $min_latitude) / 2;
    $median_longitude = ($max_longitude + $min_longitude) / 2;
    $radius = 1 / $scale;
} else {
    $median_latitude = $median_longitude = 0;
    $scale = 1;
    $radius = 1;
}

include_once "$fnsDir/create_new_item_button.php";
include_once "$fnsDir/ItemList/listHref.php";
include_once "$fnsDir/Page/tabs.php";
$content = \Page\tabs(
    [
        [
            'title' => 'Places',
            'href' => ItemList\listHref(),
        ],
    ],
    'Map',
    '<svg viewBox="-180 -90 360 180" style="vertical-align: top">'
        ."<g transform=\"scale($scale)\">"
            ."<g class=\"Clickable\" transform=\"translate(-$median_longitude, $median_latitude)\""
            .' fill="rgba(0, 0, 0, 0.3)">'
                .join('', array_map(function ($place) use ($radius) {
                    $cx = $place->longitude;
                    $cy = -$place->latitude;
                    return
                        "<circle cx=\"$cx\" cy=\"$cy\" r=\"$radius\">"
                        ."</circle>"
                        ."<circle cx=\"$cx\" cy=\"$cy\" r=\"".($radius / 2)."\">"
                        ."</circle>";
                }, $places))
            .'</g>'
        .'</g>'
    .'</svg>',
    create_new_item_button('Place', '../')
);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'Places Map', $content, '../../');
