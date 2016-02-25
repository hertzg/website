<?php

include_once '../../../../lib/defaults.php';

include_once '../../fns/require_point.php';
include_once '../../../lib/mysqli.php';
list($point, $id, $user) = require_point($mysqli, '../');

$base = '../../../';
$fnsDir = '../../../fns';

unset(
    $_SESSION['places/all-points/messages'],
    $_SESSION['places/all-points/view/messages']
);

include_once "$fnsDir/ItemList/escapedItemQuery.php";
$escapedItemQuery = ItemList\escapedItemQuery($id);

include_once '../fns/create_view_page.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    create_view_page($point, $scripts)
    .Page\confirmDialog('Are you sure you want to delete the point?'
        .' The latitude, the longitude and the altitude of the place'
        .' will be updated to the avarage of all the remaining points.',
        'Yes, delete point', "submit.php$escapedItemQuery",
        "../view/$escapedItemQuery");

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Delete Point #$id?", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
