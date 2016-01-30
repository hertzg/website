<?php

include_once '../fns/require_user.php';
include_once '../../../lib/mysqli.php';
list($user, $id, $admin_user) = require_user($mysqli);

unset($_SESSION['admin/users/view/messages']);

$fnsDir = '../../../fns';

include_once "$fnsDir/ItemList/escapedItemQuery.php";
$escapedItemQuery = ItemList\escapedItemQuery($id);

include_once '../fns/ViewPage/create.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    ViewPage\create($user, $scripts)
    .Page\confirmDialog('Are you sure you want to delete the user?',
        'Yes, delete user', "submit.php$escapedItemQuery",
        "../view/$escapedItemQuery");

include_once '../../fns/echo_admin_page.php';
include_once "$fnsDir/compressed_css_link.php";
echo_admin_page($admin_user, "Delete User #$id?", $content, '../../', [
    'head' => compressed_css_link('confirmDialog', '../../../'),
    'scripts' => $scripts,
]);
