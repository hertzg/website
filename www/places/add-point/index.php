<?php

include_once '../fns/require_place.php';
include_once '../../lib/mysqli.php';
list($place, $id, $user) = require_place($mysqli);

$key = 'places/add-point/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {
    $values = [
        'latitude' => '',
        'longitude' => '',
        'altitude' => '',
    ];
}

unset($_SESSION['places/view/messages']);

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/ItemList/escapedItemQuery.php";
$escapedItemQuery = ItemList\escapedItemQuery($id);

include_once '../fns/create_geolocation_panel.php';
include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/Form/textfield.php";
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/hidden.php";
include_once "$fnsDir/ItemList/itemHiddenInputs.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
include_once "$fnsDir/Page/warnings.php";
$content =
    Page\tabs(
        [
            [
                'title' => "Place #$id",
                'href' => "../view/$escapedItemQuery#add-point",
            ],
        ],
        'Add Point',
        Page\sessionErrors('places/add-point/errors')
        .Page\warnings(['Adding a point will update the latitude,'
            .' the longitude and the altitude of the place'
            .' to the avarage of all the points.'])
        .'<form action="submit.php" method="post">'
            .Form\textfield('latitude', 'Latitude', [
                'value' => $values['latitude'],
                'autofocus' => true,
                'required' => true,
            ])
            .'<div class="hr"></div>'
            .Form\textfield('longitude', 'Longitude', [
                'value' => $values['longitude'],
                'required' => true,
            ])
            .'<div class="hr"></div>'
            .Form\textfield('altitude', 'Altitude', [
                'value' => $values['altitude'],
            ])
            .'<div class="hr"></div>'
            .Form\button('Add Point')
            .ItemList\itemHiddenInputs($id)
        .'</form>'
    )
    .create_geolocation_panel($base, (float)$place->latitude,
        (float)$place->longitude, (float)$place->altitude);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'Add Point', $content, $base);
