<?php

include_once '../fns/require_connection.php';
include_once '../../../lib/mysqli.php';
list($connection, $id, $admin_user) = require_connection($mysqli, '../');

unset(
    $_SESSION['admin/connections/view/errors'],
    $_SESSION['admin/connections/view/messages']
);

$fnsDir = '../../../fns';

include_once "$fnsDir/ItemList/escapedItemQuery.php";
$escapedItemQuery = ItemList\escapedItemQuery($id);

include_once '../fns/ViewPage/create.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    ViewPage\create($mysqli, $connection, $scripts)
    .Page\confirmDialog('Are you sure you want to delete the connection?',
        'Yes, delete connection', "submit.php$escapedItemQuery",
        "../view/$escapedItemQuery");

include_once '../../fns/echo_admin_page.php';
include_once "$fnsDir/compressed_css_link.php";
echo_admin_page($admin_user, "Delete Connection #$id?", $content, '../../', [
    'head' => compressed_css_link('confirmDialog', '../../../'),
    'scripts' => $scripts,
]);
