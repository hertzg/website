<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_calculation.php';
include_once '../../lib/mysqli.php';
list($calculation, $id, $user) = require_calculation($mysqli);

unset(
    $_SESSION['calculations/view/errors'],
    $_SESSION['calculations/view/messages']
);

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/ItemList/escapedItemQuery.php";
$escapedItemQuery = ItemList\escapedItemQuery($id);

include_once '../fns/ViewPage/create.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    ViewPage\create($calculation, $scripts)
    .Page\confirmDialog('Are you sure you want to delete the calculation?'
        .' It will be moved to Trash.', 'Yes, delete calculation',
        "submit.php$escapedItemQuery", "../view/$escapedItemQuery");

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Delete Calculation #$id?", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
