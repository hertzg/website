<?php

include_once '../fns/require_point.php';
include_once '../../lib/mysqli.php';
list($point, $id, $user, $place) = require_point($mysqli);

include_once '../fns/request_edit_point_values.php';
$values = request_edit_point_values($point, 'places/edit-point/values');

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/ItemList/escapedItemQuery.php";
$escapedItemQuery = ItemList\escapedItemQuery($id);

unset($_SESSION['places/view-point/messages']);

include_once '../fns/create_geolocation_panel.php';
include_once '../fns/create_point_form_items.php';
include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/ItemList/itemHiddenInputs.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/warnings.php";
$content =
    Page\create(
        [
            'title' => "Point #$id",
            'href' => "../view-point/$escapedItemQuery#edit",
        ],
        'Edit',
        Page\sessionErrors('places/edit-point/errors')
        .Page\warnings(['Editing the point will update the latitude,'
            .' the longitude and the altitude of the place'
            .' to the avarage of all the points.'])
        .'<form action="submit.php" method="post">'
            .create_point_form_items($values)
            .'<div class="hr"></div>'
            .Form\button('Save Changes')
            .ItemList\itemHiddenInputs($id)
        .'</form>'
    )
    .create_geolocation_panel($base, (float)$point->latitude,
        (float)$point->longitude, (float)$point->altitude);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Edit Point #$id", $content, $base);
