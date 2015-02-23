<?php

$base = '../../../';
$fnsDir = '../../../fns';

include_once '../fns/require_received_place.php';
include_once '../../../lib/mysqli.php';
list($receivedPlace, $id, $user) = require_received_place($mysqli, '../');

unset($_SESSION['places/received/view/messages']);

$key = 'places/received/edit-and-import/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = (array)$receivedPlace;

include_once "$fnsDir/Places/maxLengths.php";
$maxLengths = Places\maxLengths();

include_once "$fnsDir/ItemList/Received/escapedItemQuery.php";
$escapedItemQuery = ItemList\Received\escapedItemQuery($id);

include_once '../../fns/create_form_items.php';
include_once '../../fns/create_geolocation_panel.php';
include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/hidden.php";
include_once "$fnsDir/ItemList/Received/itemHiddenInputs.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
$content =
    Page\tabs(
        [
            [
                'title' => "Received Place #$id",
                'href' => "../view/$escapedItemQuery#edit-and-import",
            ],
        ],
        'Edit and Import',
        Page\sessionErrors('places/received/edit-and-import/errors')
        .'<form action="submit.php" method="post">'
            .create_form_items($values)
            .'<div class="hr"></div>'
            .Form\button('Import Place')
            .ItemList\Received\itemHiddenInputs($id)
        .'</form>'
    )
    .create_geolocation_panel($base, (float)$receivedPlace->latitude,
        (float)$receivedPlace->longitude, (float)$receivedPlace->altitude)
    .compressed_js_script('flexTextarea', $base)
    .compressed_js_script('formCheckbox', $base);

include_once "$fnsDir/echo_page.php";
$title = "Edit and Import Received Place #$id";
echo_page($user, $title, $content, $base);
