<?php

include_once '../../../../lib/defaults.php';

$base = '../../../';
$fnsDir = '../../../fns';

include_once '../fns/require_received_place.php';
include_once '../../../lib/mysqli.php';
list($receivedPlace, $id, $user) = require_received_place($mysqli, '../');

unset($_SESSION['places/received/view/messages']);

$key = 'places/received/edit-and-import/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    $values = [
        'focus' => 'latitude',
        'latitude' => $receivedPlace->latitude,
        'longitude' => $receivedPlace->longitude,
        'altitude' => $receivedPlace->altitude,
        'name' => $receivedPlace->name,
        'description' => $receivedPlace->description,
        'tags' => $receivedPlace->tags,
    ];
}

include_once "$fnsDir/Places/maxLengths.php";
$maxLengths = Places\maxLengths();

include_once "$fnsDir/ItemList/Received/escapedItemQuery.php";
$escapedItemQuery = ItemList\Received\escapedItemQuery($id);

include_once '../../fns/create_form_items.php';
include_once '../../fns/create_geolocation_panel.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/ItemList/Received/itemHiddenInputs.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
$content =
    Page\create(
        [
            'title' => "Received Place #$id",
            'href' => "../view/$escapedItemQuery#edit-and-import",
        ],
        'Edit and Import',
        Page\sessionErrors('places/received/edit-and-import/errors')
        .'<form action="submit.php" method="post">'
            .create_form_items($values, $scripts, '../')
            .Form\button('Import Place')
            .ItemList\Received\itemHiddenInputs($id)
        .'</form>'
    )
    .create_geolocation_panel($scripts, $base, (float)$receivedPlace->latitude,
        (float)$receivedPlace->longitude, (float)$receivedPlace->altitude);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Edit and Import Received Place #$id",
    $content, $base, ['scripts' => $scripts]);
