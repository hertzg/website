<?php

include_once '../fns/require_place.php';
include_once '../../lib/mysqli.php';
list($place, $id, $user) = require_place($mysqli);

$key = 'places/edit/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    $values = [
        'focus' => 'latitude',
        'latitude' => $place->latitude,
        'longitude' => $place->longitude,
        'altitude' => $place->altitude,
        'name' => $place->name,
        'description' => $place->description,
        'tags' => $place->tags,
    ];
}

unset($_SESSION['places/view/messages']);

$base = '../../';
$fnsDir = '../../fns';

if ($place->num_points > 1) {
    $warning = 'Changing the latitude, the longitude or the altitude'
        .' will delete all the points that has been added to this place.';
    include_once "$fnsDir/Page/warnings.php";
    $warnings = Page\warnings([$warning]);
} else {
    $warnings = '';
}

include_once '../fns/create_form_items.php';
include_once '../fns/create_geolocation_panel.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/ItemList/escapedItemQuery.php";
include_once "$fnsDir/ItemList/itemHiddenInputs.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/staticTwoColumns.php";
$content =
    Page\create(
        [
            'title' => "Place #$id",
            'href' => '../view/'.ItemList\escapedItemQuery($id).'#edit',
        ],
        'Edit',
        Page\sessionErrors('places/edit/errors')
        .$warnings
        .'<form action="submit.php" method="post">'
            .create_form_items($values, $scripts)
            .'<div class="hr"></div>'
            .Page\staticTwoColumns(
                Form\button('Save Changes'),
                Form\button('Send', 'sendButton')
            )
            .ItemList\itemHiddenInputs($id)
        .'</form>'
    )
    .create_geolocation_panel($scripts, $base, (float)$place->latitude,
        (float)$place->longitude, (float)$place->altitude);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Edit Place #$id",
    $content, $base, ['scripts' => $scripts]);
