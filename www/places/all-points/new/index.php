<?php

include_once '../../fns/require_place.php';
include_once '../../../lib/mysqli.php';
list($place, $id, $user) = require_place($mysqli, '../');

unset($_SESSION['places/all-points/messages']);

include_once '../../fns/request_new_point_values.php';
$values = request_new_point_values('places/all-points/new/values');

$base = '../../../';
$fnsDir = '../../../fns';

include_once '../../fns/create_point_form_items.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/ItemList/escapedItemQuery.php";
include_once "$fnsDir/ItemList/itemHiddenInputs.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
include_once "$fnsDir/Page/warnings.php";
$content = Page\tabs(
    [
        [
            'title' => 'All Points',
            'href' => '../'.ItemList\escapedItemQuery($id),
        ]
    ],
    'Add New',
    Page\sessionErrors('places/all-points/new/errors')
    .Page\warnings(['Adding a new point will update the latitude,'
        .' the longitude and the altitude of the place'
        .' to the avarage of all the points.'])
    .'<form action="submit.php" method="post">'
        .create_point_form_items($values)
        .'<div class="hr"></div>'
        .Form\button('Save Point')
        .ItemList\itemHiddenInputs($id)
    .'</form>'
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Add New Point to Place #$place->id", $content, $base);
