<?php

include_once '../../../../lib/defaults.php';

include_once '../../fns/require_place.php';
include_once '../../../lib/mysqli.php';
list($place, $id, $user) = require_place($mysqli, '../');

unset(
    $_SESSION['places/all-points/messages'],
    $_SESSION['places/all-points/view/messages']
);

include_once '../../fns/request_new_point_values.php';
$values = request_new_point_values('places/all-points/new/values');

$base = '../../../';
$fnsDir = '../../../fns';

include_once '../../fns/create_geolocation_panel.php';
include_once '../../fns/create_point_form_items.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/ItemList/escapedItemQuery.php";
include_once "$fnsDir/ItemList/itemHiddenInputs.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/warnings.php";
$content =
    Page\create(
        [
            'title' => 'All Points',
            'href' => '../'.ItemList\escapedItemQuery($id),
        ],
        'Add New',
        Page\sessionErrors('places/all-points/new/errors')
        .Page\warnings(['Adding a new point will update the latitude,'
            .' the longitude and the altitude of the place'
            .' to the avarage of all the points.'])
        .'<form action="submit.php" method="post">'
            .create_point_form_items($values)
            .Form\button('Save Point')
            .ItemList\itemHiddenInputs($id)
        .'</form>'
    )
    .create_geolocation_panel($scripts, $base, (float)$place->latitude,
        (float)$place->longitude, (float)$place->altitude);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Add New Point to Place #$place->id",
    $content, $base, ['scripts' => $scripts]);
